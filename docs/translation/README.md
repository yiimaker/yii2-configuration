Configuration Translation
=============
Component Configuration is designed to store data such as key-value with the internationalization.

Providers
---------
[DB Provider](docs/db-provider.md)

Configuration
-------------

In configuration file
```php
'components' => [
    'config' => [
        'class' => '\ymaker\configuration\translation\Configuration',
        'provider' => [
    'class' => '\ymaker\configuration\providers\translation\DbProvider',
            'tableName' => '{{%configuration}}',  // by default
            'keyColumn' => 'key',                 // by default
            'valueColumn' => 'value',             // by default
        ]
    ],
    ...
]
```
Create own provider
--------------------
1. Create Class for provider
2. Implement `\ymaker\configuration\translation\TranslationProviderInterface`
3. Change in the configuration file on your provider

Usage
-----

Db provider example
```php
$isSet = \Yii::$app->config->set('commission', '10');       // can throw an exception
$isSet = \Yii::$app->config->safeSet('commission', '10');   // return false if something went wrong

$isSet = \Yii::$app->config->exists('commission');          // return true if key exists
$value = \Yii::$app->config->get('commission');             // return '10';
``` 
