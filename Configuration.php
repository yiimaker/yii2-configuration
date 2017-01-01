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

    public function get($key)
    {
        return $this->provider->get($key);
    }

    public function set($key, $value)
    {
        return $this->provider->set($key, $value);
    }
}