<?php

namespace ymaker\configuration\providers;

use yii\base\Component;
use yii\db\Exception;
use yii\db\Query;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use ymaker\configuration\ProviderInterface;

/**
 * Class DbProvider
 * @package ymaker\configuration\providers
 * @author Ruslan Saiko <ruslan.saiko.dev@gmail.com>
 */
class DbProvider extends Component implements ProviderInterface
{
    public $db = 'db';
    public $tableName = "{{%configuration}}";
    public $keyColumn = "key";
    public $valueColumn = "value";

    public function init()
    {
        parent::init();
        $this->db = Instance::ensure($this->db);
    }

    /** @inheritdoc */
    function get($key)
    {
        $result = $this->findOneByKey($key, $this->valueColumn);
        return $result[$this->valueColumn];
    }

    /** @inheritdoc */
    function set($key, $value)
    {
        try {
            $rawNumber = (new Query())
                ->createCommand($this->db)
                ->insert($this->tableName, [
                    $this->keyColumn => $key,
                    $this->valueColumn => $value,
                ])
                ->execute();
            return isset($rawNumber);

        } catch (Exception $e) {
            \Yii::error($e->getTraceAsString());
            return false;
        }
    }

    /**
     *
     * @param $key
     * @param array $columns
     * @return array|bool
     */
    private function findOneByKey($key, $columns = [])
    {
        return (new Query())
            ->select($columns)
            ->from($this->tableName)
            ->where([
                $this->keyColumn => $key
            ])
            ->limit(1)
            ->one($this->db);
    }

    /**
     *  return tru if this key exist
     * @param $key string
     * @return boolean
     */
    function exists($key)
    {
        $configRaw = $this->findOneByKey($key, $this->keyColumn);
        return !empty($configRaw);
    }
}