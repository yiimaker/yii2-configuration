<?php

namespace ymaker\configuration\translation;

use ymaker\configuration\ProviderInterface;

/**
 * Interface TranslationProviderInterface
 * @package ymaker\configuration\translation
 * @author Ruslan Saiko <ruslan.saiko.dev@gmail.com>
 */
interface TranslationProviderInterface extends ProviderInterface
{
    /**
     * @param $key string
     * @param $language string
     * @return string|null
     */
    public function getTranslation($key, $language);

    /**
     * @param $keys string[]
     * @param $language string
     * @return string[] retrun values
     */
    public function getMultiplyTranslation($keys, $language);
    /**
     * @param string $key
     * @param string $value
     * @param string $language
     * @return boolean
     */
    public function setTranslation($key, $value, $language);

    /**
     * @param string $key
     * @param string $language
     * @return boolean
     */
    public function translationExists($key, $language);

}