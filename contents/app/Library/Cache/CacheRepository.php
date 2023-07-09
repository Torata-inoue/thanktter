<?php

namespace App\Library\Cache;

use Redis;

/**
 * DBとは接続せずRedis(KVS)とのみやりとりするリポジトリ
 * Class CacheRepository
 * @package App\Libraries\Cache
 */
abstract class CacheRepository
{
    const ZIP_LEVEL = 9;

    /**
     * Redisの接続先
     * @var string
     */
    protected string $connection = 'data_cache';

    /**
     * キャッシュキーのプリフィクス
     * @var string
     */
    protected string $prefix = 'cache:';

    /**
     * @var Redis
     */
    protected Redis $redis;

    /**
     * キャッシュを使う設定
     * @var bool
     */
    protected bool $useCache = true;

    public function __construct()
    {
        $this->redis = app('redis')->connection($this->connection)->client();
    }

    /**
     * @param string $data
     * @return string
     */
    protected function zip(string $data): string
    {
        return gzencode($data, static::ZIP_LEVEL);
    }

    /**
     * @param string|false $data
     * @return string|null
     */
    protected function unzip(string|false $data): ?string
    {
        return match ($data) {
            false => null,
            '' => $data,
            default => gzdecode($data)
        };
    }
}
