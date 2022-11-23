<?php

namespace KamilMakosa\LaravelCacheClass;

class CacheClass
{
    protected static $key;

    /**
     * Prepare data for cache.
     *
     * @return mixin
     */
    public static function data()
    {
        return null;
    }

    /**
     * Get the key.
     *
     * @return string
     */
    public static function getKey()
    {
        return static::$key ?? Str::of(class_basename(self))->snake();
    }

    /**
     * Remove an item from the cache.
     *
     * @return bool
     */
    public static function forget()
    {
        Cache::forget(self::$cacheKey);
    }

    /**
     * Retrieve an item from the cache by key.
     *
     * @return mixed
     */
    public static function get()
    {
        if (!Cache::has(static::$key)) {
            static::refresh();
        }

        return Cache::get(static::$key);
    }

    /**
     * Store an item in the cache for a given number of seconds.
     *
     * @param  mixed  $value
     * @param  int  $seconds
     * @return bool
     */
    public static function put($value, $seconds = null)
    {
        Cache::put(static::$key, $value, $seconds);
    }

    /**
     * Refresh a item in the cache.
     *
     * @param  int  $seconds
     */
    public static function refresh($seconds = null)
    {
        static::put(static::data(), $seconds);
    }
}
