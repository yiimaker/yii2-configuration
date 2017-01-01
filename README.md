Configuration Component
=======================
Configuration component is designed for key-value type data storage.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiimaker/yii2-configuration "*"
```

or add

```
"yiimaker/yii2-configuration": "*"
```

to the require section of your `composer.json` file.

Providers
---------
[DB Provider](docs/db-provider.md)

Configuration
-------------

In configuration file
```php
'components' => [
    'config' => [
        'class' => '\ymaker\configuration\Configuration',
        'provider' => [
            'class' => '\ymaker\configuration\providers\DbProvider',
            'tableName' => '{{%configuration}}',  //by default
            'keyColumn' => 'key',                 //by default
            'valueColumn' => 'value',             //by default
        ]
    ],
    ...
]
```
Create own provider
--------------------
1. Create Class for provider
2. Implement \ymaker\configuration\ProviderInterface
3. Change in the configuration file on your provider

Usage
-----

Db provider example
```php
$isSet = \Yii::$app->config->set('commission', '10');   // return false if something went wrong
$value = \Yii::$app->config->get('commission');         // return '10';
```
