<?php

namespace ymaker\configuration;

/**
 * Interface ProviderInterface
 * This interface must implement every provider
 * @package ymaker\configuration
 * @author Ruslan Saiko <ruslan.saiko.dev@gmail.com>
 */
interface ProviderInterface
{
    /**
     * get value from configuration by key
     * @param $key string
     * @return string|null
     */
    public function get($key);

    /**
     * set value to configuration
     * @param $key string
     * @param $value string
     * @return bool
     */
    public function set($key, $value);

    /**
     *  return true if this key exist
     * @param $key string
     * @return boolean
     */
    public function exists($key);
}