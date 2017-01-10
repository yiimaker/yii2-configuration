<?php

namespace ymaker\configuration\translation\providers;

use yii\db\Query;
use yii\helpers\ArrayHelper;
use ymaker\configuration\translation\TranslationProviderInterface;

/**
 * Class DbProvider
 * @package ymaker\configuration\translation\providers
 * @author Ruslan Saiko <ruslan.saiko.dev@gmail.com>
 */
class DbProvider extends \ymaker\configuration\providers\DbProvider implements TranslationProviderInterface
{

    public $tableName = '{{%configuration_translation}}';
    public $keyColumn = 'key';
    public $valueColumn = 'value';
    public $languageColumn = 'language';

    /**
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function set($key, $value)
    {
        $language = \Yii::$app->language;
        return $this->setTranslation($key, $value, $language);
    }

    /**
     * @param string $key
     * @return null|string
     */
    public function get($key)
    {
        $language = \Yii::$app->language;
        return $this->getTranslation($key, $language);
    }

    /**
     * @param string $key
     * @param string $language
     * @return string|null
     */
    public function getTranslation($key, $language)
    {
        $defaultLanguage = $language ?: \Yii::$app->sourceLanguage;

        $query = (new Query())
            ->select($this->valueColumn)
            ->from($this->tableName)
            ->where(
                [
                    $this->keyColumn => $key,
                    $this->languageColumn => $defaultLanguage,
                ]);
        $value = $query->one($this->db);
        return $value ? $value[$this->valueColumn] : null;
    }

    /**
     * @param string $key
     * @param string $value
     * @param string $language
     * @return boolean
     */
    public function setTranslation($key, $value, $language)
    {
        $defaultLanguage = $language ?: \Yii::$app->sourceLanguage;
        $rawNumber = null;
        $query = new Query();
        $command = $query->createCommand($this->db);
        if ($this->translationExists($key, $defaultLanguage)) {
            $command = $command->update($this->tableName,
                [
                    $this->valueColumn => $value,
                    $this->languageColumn => $defaultLanguage,
                ],
                [ // condition
                    $this->keyColumn => $key,
                    $this->languageColumn => $defaultLanguage
                ]
            );
        } else {
            $command = $command->insert($this->tableName, [
                $this->keyColumn => $key,
                $this->valueColumn => $value,
                $this->languageColumn => $defaultLanguage,
            ]);
        }
        $rawNumber = $command->execute();
        return isset($rawNumber);
    }

    public function translationExists($key, $language)
    {
        return (new Query())
            ->select($this->keyColumn)
            ->from($this->tableName)
            ->where(
                [
                    $this->keyColumn => $key,
                    $this->languageColumn => $language
                ])
            ->exists($this->db);
    }

    public function exists($key)
    {
        $language =  \Yii::$app->language;
        return $this->translationExists($key, $language);
    }

    /**
     * @param $keys array
     * @return string[]
     */
    public function getMultiply($keys)
    {
        $language = \Yii::$app->language;
        return $this->getMultiplyTranslation($keys, $language);
    }

    /**
     * @param $keys string[]
     * @param $language string
     * @return string[] retrun values
     */
    public function getMultiplyTranslation($keys, $language)
    {
        $valuesQuery = (new Query())
            ->select([$this->keyColumn, $this->valueColumn])
            ->from($this->tableName)
            ->where([
                $this->keyColumn => $keys,
                $this->languageColumn => $language
            ]);
        $values = ArrayHelper::map($valuesQuery->all($this->db), $this->keyColumn, $this->valueColumn);
        return $values;
    }
}