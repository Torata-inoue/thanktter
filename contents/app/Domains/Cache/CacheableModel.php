<?php

namespace App\Domains\Cache;

use Illuminate\Database\Eloquent\Model;

abstract class CacheableModel extends Model
{
    /**
     * キャッシュの接続名
     * @var string
     */
    protected string $dbCacheConnection = 'cache';

    /**
     * キャッシュの有効期限(秒)
     * 0 を設定すると無期限
     * @var int
     */
    protected int $dbCacheExpire = 300;

    /**
     * キャッシュから作成されたインスタンスか
     * @var bool
     */
    protected bool $isCache = false;

    /**
     * キャッシュキーの接頭辞
     * @var string
     */
    protected string $dbCachePrefix = 'model';

    /**
     * キャッシュサーバの接続先情報を返す
     * @return string
     */
    public function getDbCacheConnection(): string
    {
        return $this->dbCacheConnection;
    }

    /**
     * キャッシュの有効期限(秒)を返す
     * @return int
     */
    public function getDbCacheExpire(): int
    {
        return $this->dbCacheExpire;
    }

    /**
     * キャッシュキーの接頭辞を返す
     * @return string
     */
    public function getDbCachePrefix(): string
    {
        return $this->dbCachePrefix;
    }

    /**
     * キャッシュサーバの接続先情報を設定
     * @param string $db_cache_connection
     */
    public function setDbCacheConnection(string $db_cache_connection): void
    {
        $this->dbCacheConnection = $db_cache_connection;
    }

    public function isCache(): bool
    {
        return $this->isCache;
    }

    /**
     * unserializeでインスタンスを生成した場合にコールされる処理
     */
    public function __wakeup()
    {
        parent::__wakeup();
        $this->isCache = true;
    }
}
