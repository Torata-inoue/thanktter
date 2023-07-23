<?php

namespace App\Domains\Cache;

use App\Domains\Repository;
use Illuminate\Database\Eloquent\Model;
use Redis;

/**
 * @template TModel of CacheableModel
 * @extends Repository<TModel>
 */
class CacheableRepository extends Repository
{
    protected Redis $redis;

    protected bool $useCache = true;

    /**
     * @var CacheableModel
     */
    protected Model $model;

    /**
     * Cacheable constructor.
     * @param CacheableModel $model
     */
    public function __construct(CacheableModel $model)
    {
        // モデル定義
        parent::__construct($model);

        // redis クライアント
        $this->redis = app('redis')->connection($this->model->getDbCacheConnection())->client();
    }

    /**
     * @param bool $useCache
     */
    public function setUseCache(bool $useCache): void
    {
        $this->useCache = $useCache;
    }

    /**
     * @return bool
     */
    public function getUseCache(): bool
    {
        return $this->useCache;
    }

    /**
     * ID からレコード情報取得
     *
     * キャッシュ有効かつ、データが存在したらキャッシュから取得
     * そうでなければ DB から取得し、キャッシュ有効はキャッシュに登録する
     * @param int $id
     * @return TModel|null
     * @throws \RedisException
     */
    public function findById(int $id): ?CacheableModel
    {
        // キャッシュから取得
        if ($this->useCache && $model = $this->findByIdFromCache($id)) {
            return $model;
        }

        // DB から取得
        $model = $this->findByIdFromDb($id);

        // キャッシュへ保存
        if ($this->useCache && $model) {
            $this->setDbCache($model);
        }
        return $model;
    }

    /**
     * キャッシュキー取得
     * @param int $id
     * @return string
     */
    protected function getDbCacheKey(int $id): string
    {
        return $this->model->getDbCachePrefix(). ':'. $this->model->getTable(). ':'. $id;
    }

    /**
     * キャッシュ登録
     * @param CacheableModel $model
     * @throws \RedisException
     */
    public function setDbCache(CacheableModel $model): void
    {
        // キャッシュキー生成
        $key = $this->getDbCacheKey($model->getKey());

        $expire = $this->model->getDbCacheExpire();
        $serialize_data = serialize($model);

        if ($expire > 0) {
            // 有効期限あり
            $this->redis->setex($key, $expire, $serialize_data);
        } else {
            // 有効期限なし
            $this->redis->set($key, $serialize_data);
        }
    }

    /**
     * キャッシュから ID 指定でレコード情報取得
     * @param int $id
     * @return TModel|null
     * @throws \RedisException
     */
    protected function findByIdFromCache(int $id): ?CacheableModel
    {
        return unserialize($this->redis->get($this->getDbCacheKey($id))) ?: null;
    }

    /**
     * DB から ID 指定でレコード情報取得
     * @param int $id
     * @return TModel|null
     */
    protected function findByIdFromDB(int $id): ?CacheableModel
    {
        /** @var CacheableModel|null $result */
        $result = $this->getQueryBuilder()
            ->where($this->model->getKeyName(), '=', $id)
            ->first();

        return $result;
    }
}
