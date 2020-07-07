<?php

namespace Services\Cache;

use Closure;
use Memcached;

/**
 * Class Cache
 * @package LesniakSwann\CSCartProducts\Cache
 * @author Simon Nicklin <@SimonNjO>
 */
class Cache
{
    /**
     * @var Memcached
     */
    protected $cache;

    /**
     * @var integer
     */
    protected $default_ttl = 7200; // 6 hours in seconds

    /**
     * @var string
     */
    protected $prefix = "ls_";

    /**
     * Cache constructor.
     *
     * @param $address
     * @param $port
     */
    public function __construct($address = '', $port = '')
    {
        $this->cache = new Memcached();

        if ($address != '' && $port != '') {
            $this->cache->addServer($address, $port);
        }
    }

    /**
     * @param $address
     * @param $port
     *
     * @return $this
     */
    public function addServer($address, $port)
    {
        $this->cache->addServer($address, $port);

        return $this;
    }

    /**
     * @param $key
     * @param $ttl
     * @param Closure $callback
     *
     * @return mixed
     */
    public function remember($key, Closure $callback, $ttl = null)
    {
        $value = $this->get($key);

        if (! is_null($value) && $value !== false) {
            return $value;
        }

        $this->set($key, $value = $callback($key), $this->checkTtl($ttl));

        return $value;
    }

    /**
     * @param $key
     *
     * @param null|Closure|mixed $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $value = $this->cache->get($this->key($key));

        // Use default if cache result was a miss.  You can use a closure as a default.
        if (is_null($value) || $value === false) {
            $value = ($value instanceof Closure) ? $default() : $default;
        }

        return $value;
    }

    /**
     * @param $key
     * @param $value
     * @param null $ttl
     *
     * @return mixed
     */
    public function set($key, $value, $ttl = null)
    {
        return $this->cache->set($this->key($key), $value, $this->checkTtl($ttl));
    }

    /**
     * Store an item in the cache indefinitely.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    public function forever($key, $value)
    {
        $this->set($key, $value, 0);
    }

    /**
     * Remove an item from the cache.
     *
     * @param  string  $key
     * @return bool
     */
    public function forget($key)
    {
        return $this->cache->delete($this->key($key));
    }

    /**
     * Remove all items from the cache.
     *
     * @return bool
     */
    public function flush()
    {
        return $this->cache->flush();
    }

    /**
     * @param $ttl
     *
     * @return int|string
     */
    private function checkTtl($ttl)
    {
        return ($ttl == null || !is_numeric($ttl)) ? $this->default_ttl : $ttl;
    }

    /**
     * @param $key
     *
     * @return string
     */
    private function key($key)
    {
        return $this->prefix.$key;
    }

    /**
     * @param string $prefix
     *
     * @return $this
     */
    public function setPrefix($prefix)
    {
        if ($prefix != '') {
            $this->prefix = $prefix;
        }

        return $this;
    }

}