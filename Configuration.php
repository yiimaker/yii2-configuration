<?php

namespace ymaker\configuration;

use yii\base\Component;
use yii\di\Instance;

/**
 * Class Configuration
 * @package ymaker\configuration
 * @author Ruslan Saiko <ruslan.saiko.dev@gmail.com>
 */
class Configuration extends Component implements ProviderInterface
{
    /**
     * @var ProviderInterface
     */
    public $provider;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->provider = Instance::ensure($this->provider);
    }

    /** @inheritdoc */
    public function get($key)
    {
        return $this->provider->get($key);
    }

    /** @inheritdoc */
    public function set($key, $value)
    {
        return $this->provider->set($key, $value);
    }


    /** @inheritdoc */
    function exists($key)
    {
        return $this->provider->exists($key);
    }
}