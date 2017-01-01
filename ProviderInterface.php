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
    function get($key);

    /**
     * set
     * @param $key string
     * @param $value string
     * @return bool
     */
    function set($key, $value);
}