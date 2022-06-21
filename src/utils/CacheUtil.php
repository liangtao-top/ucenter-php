<?php
declare(strict_types=1);
// +----------------------------------------------------------------------
// | CodeEngine
// +----------------------------------------------------------------------
// | Copyright 艾邦
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: TaoGe <liangtao.gz@foxmail.com>
// +----------------------------------------------------------------------
// | Version: 2.0 2022/6/20 11:17
// +----------------------------------------------------------------------
namespace top\liangtao\ucenter\utils;

use DateTime;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class CacheUtil
{
    /**
     * cachePool
     * @return \Symfony\Component\Cache\Adapter\FilesystemAdapter
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 12:08
     */
    private static function cache(): FilesystemAdapter
    {
        return new FilesystemAdapter('', 0, dirname(__DIR__) . DIRECTORY_SEPARATOR . 'cache');
    }

    /**
     * set
     * @param string         $key
     * @param mixed          $value
     * @param int $expires
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 12:11
     */
    public static function set(string $key, mixed $value, ?int $expires = null): void
    {
        $cache = self::cache();
        $item  = $cache->getItem($key);
        $item->set($value);
        if (!is_null($expires)) {
            $item->expiresAfter($expires);
        }
        $cache->save($item);
    }

    /**
     * get
     * @param string $key
     * @return mixed
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 12:13
     */
    public static function get(string $key): mixed
    {
        $cache = self::cache();
        if (!$cache->hasItem($key)) {
            return null;
        }
        return $cache->getItem($key)->get();
    }

    /**
     * del
     * @param string $key
     * @return bool
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 12:24
     */
    public static function del(string $key): bool
    {
        return self::cache()->deleteItem($key);
    }

    /**
     * has
     * @param string $key
     * @return bool
     * @throws \Psr\Cache\InvalidArgumentException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 12:10
     */
    public static function has(string $key): bool
    {
        return self::cache()->hasItem($key);
    }

    /**
     * clear
     * @return bool
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/6/20 12:09
     */
    public static function clear(): bool
    {
        return self::cache()->clear();
    }
}
