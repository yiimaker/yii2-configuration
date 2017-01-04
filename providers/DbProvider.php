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
    public function get($key)
    {
        $result = $this->findOneByKey($key, $this->valueColumn);
        return $result[$this->valueColumn];
    }

    /** @inheritdoc */
    public function set($key, $value)
    {
        $rawNumber = null;
        $query = new Query();
        $command = $query->createCommand($this->db);
        if ($this->exists($key)) {
            $command = $command->update($this->tableName, [
                $this->keyColumn => $key,
                $this->valueColumn => $value,
            ],
                [$this->keyColumn => $key]
            );
        } else {
            $command = $command->insert($this->tableName, [
                $this->keyColumn => $key,
                $this->valueColumn => $value,
            ]);
        }
        $rawNumber = $command->execute();
        return isset($rawNumber);
    }

    /** @inheritdoc */
    public function safeSet($key, $value)
    {
        try {
            $this->set($key, $value);
        } catch (Exception $e) {
            \Yii::error($e->getTraceAsString());
            return false;
        }
    }

    /** @inheritdoc */
    public function exists($key)
    {
        return (new Query())
            ->select($this->keyColumn)
            ->from($this->tableName)
            ->where([$this->keyColumn => $key])
            ->exists($this->db);
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

}