<?php

namespace App\Domains\Cache;

class CacheObserver
{
    /**
     * DB レコード追加更新前処理
     * キャッシュから取得したレコードならエラー
     * @param CacheableModel $model
     * @return bool
     * @throws SaveCacheException
     */
    public function saving(CacheableModel $model): bool
    {
        if ($model->isCache()) {
            throw new SaveCacheException(get_class($model));
        }
        return true;
    }

    /**
     * @param CacheableModel $model
     * @throws \Exception
     */
    public function saved(CacheableModel $model): void
    {
        $cacheable = new CacheableRepository($model);

        if ($model->wasRecentlyCreated) {
            // 作成されたばかりのエンティティ

            // テーブル側のデフォルト値が入っていないので、一度DBから取得する
            $cacheable->setUseCache(false);
            $model = $cacheable->findById($model->getKey());
        } else {
            // publicプロパティを初期化
            $newInstance = $model->newInstance();
            $model->timestamps = $newInstance->timestamps;
            $model->incrementing = $newInstance->incrementing;
        }

        $cacheable->setDbCache($model);
    }
}
