<?php

namespace App\Domains\Cache;

use App\Domains\Repository;
use Illuminate\Database\Eloquent\Builder;
use Redis;

/**
 * @template TModel of CacheableModel
 * @template TBuilder of Builder<TModel>
 * @extends Repository<TModel, TBuilder>
 * @property TModel $model
 */
class CacheableRepository extends Repository
{
    protected Redis $redis;

    protected bool $useCache = true;

    /**
     * Cacheable constructor.
     * @param TModel $model
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
     * @param TModel $model
     */
    public function setDbCache(CacheableModel $model): void
    {
        // キャッシュキー生成
        $key = $this->getDbCacheKey($model->getKey());

        $expire = $this->model->getDbCacheExpire();
        $serialize_data = serialize($model);

        try {
            if ($expire > 0) {
                // 有効期限あり
                $this->redis->setex($key, $expire, $serialize_data);
            } else {
                // 有効期限なし
                $this->redis->set($key, $serialize_data);
            }
        } catch (\RedisException $e) {
            //
        }
    }

    /**
     * キャッシュから ID 指定でレコード情報取得
     * @param int $id
     * @return TModel|null
     */
    protected function findByIdFromCache(int $id): ?CacheableModel
    {
        try {
            return unserialize($this->redis->get($this->getDbCacheKey($id))) ?: null;
        } catch (\RedisException $e) {
            return null;
        }
    }

    /**
     * DB から ID 指定でレコード情報取得
     * @param int $id
     * @return TModel|null
     */
    protected function findByIdFromDB(int $id): ?CacheableModel
    {
        return $this->getQueryBuilder()
            ->where($this->model->getKeyName(), '=', $id)
            ->first();
    }
}
