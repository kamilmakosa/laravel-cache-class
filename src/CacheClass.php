<?php

namespace KamilMakosa\CacheClass;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CacheClass
{
    protected static $key;

    protected static $seconds;

    /**
     * Prepare data for cache.
     *
     * @return mixin
     */
    public function data()
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
        $prefix = config('cache.laravel_cache_class.prefix') . '_';

        return static::$key ? $prefix . static::$key : $prefix . Str::of(class_basename(static::class))->snake();
    }

    /**
     * Get the seconds.
     *
     * @return string
     */
    public static function getSeconds()
    {
        return static::$seconds;
    }

    /**
     * Remove an item from the cache.
     *
     * @return bool
     */
    public static function forget()
    {
        Cache::forget(static::getKey());
    }

    /**
     * Retrieve an item from the cache by key.
     *
     * @return mixed
     */
    public static function get()
    {
        if (!Cache::has(static::getKey())) {
            static::refresh();
        }

        return Cache::get(static::getKey());
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
        if (is_null($seconds)) {
            $seconds = static::getSeconds();
        }

        Cache::put(static::getKey(), $value, $seconds);
    }

    /**
     * Refresh a item in the cache.
     *
     * @param  int  $seconds
     */
    public static function refresh($seconds = null)
    {
        if (is_null($seconds)) {
            $seconds = static::getSeconds();
        }

        $data = (new static)->data();

        static::put($data, $seconds);
    }
}
