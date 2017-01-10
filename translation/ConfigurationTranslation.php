<?php

namespace ymaker\configuration\translation;

use ymaker\configuration\Configuration;

/**
 * Class ConfigurationTranslation
 * @package ymaker\configuration\translation
 * @author Ruslan Saiko <ruslan.saiko.dev@gmail.com>
 */
class ConfigurationTranslation extends Configuration implements TranslationProviderInterface
{
    /**
     * @var TranslationProviderInterface
     */
    public $provider;

    /**
     * @param string $key
     * @param string $language
     * @return string|null
     */
    public function getTranslation($key, $language)
    {
        return $this->provider->getTranslation($key, $language);
    }

    /**
     * @param string $key
     * @param string $value
     * @param string $language
     * @return boolean
     */
    public function setTranslation($key, $value, $language)
    {
        return $this->provider->setTranslation($key, $value, $language);
    }

    /**
     * @param string $key
     * @param string $language
     * @return boolean
     */
    public function translationExists($key, $language)
    {
        return $this->provider->translationExists($key, $language);
    }

    /**
     * @param $keys array
     * @param $language string
     * @return string[]
     */
    public function getMultiplyTranslation($keys, $language)
    {
        return $this->provider->getMultiplyTranslation($keys, $language);
    }
}