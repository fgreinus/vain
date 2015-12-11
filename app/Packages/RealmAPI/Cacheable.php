<?php

namespace Vain\Packages\RealmAPI;

trait Cacheable
{
    /**
     * @var bool
     */
    protected $useCache;

    /**
     * @var int
     */
    protected $cacheDuration;

    public function __construct()
    {
        $this->cacheDuration = Carbon::now()->addMinutes(10);
    }

    /**
     * @param bool $useCache
     *
     * @return $this
     */
    public function setUseCache($useCache)
    {
        $this->useCache = $useCache;

        return $this;
    }

    /**
     * @param int $cacheDuration
     *
     * @return $this
     */
    public function setCacheDuration($cacheDuration)
    {
        $this->cacheDuration = $cacheDuration;

        return $this;
    }

    /**
     * generates a cache key by passed args
     * realm id and realm type will automatically supplemented.
     */
    protected function cacheKey()
    {
        return implode('-', array_merge(func_get_args(), [$this->type, $this->realm]));
    }
}
