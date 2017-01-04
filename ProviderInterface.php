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
     * @return string|null return value if it was set
     */
    public function get($key);

    /**
     * set value to configuration
     * @param $key string
     * @param $value string
     * @return bool true if successful preservation
     */
    public function set($key, $value);

    /**
     * safe set value to configuration
     * @param $key string
     * @param $value string
     * @return bool true if saved successfully, otherwise false
     */
    public function safeSet($key, $value);

    /**
     *  return true if this key exist
     * @param $key string
     * @return boolean returns true if the key has been set
     */
    public function exists($key);
}