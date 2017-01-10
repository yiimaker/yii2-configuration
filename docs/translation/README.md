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
            'tableName' => '{{%configuration_translation}}',  // by default
            'keyColumn' => 'key',                             // by default
            'valueColumn' => 'value',                         // by default
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
$isSet = \Yii::$app->config->set('address', 'Kiev, Ukraine');
$value = \Yii::$app->config->get('address'); // return 'Kiev, Ukraine';
$isSetTranslation = \Yii::$app->config->setTranslation('address', 'Киев, Украина' 'ru-RU');
$valueTranslation = \Yii::$app->config->getTranslation('address', 'ru-RU'); // return 'Киев, Украина';

$isSetTranslation = \Yii::$app->config->setTranslation('phone', '+111111111111' 'ru-RU');
$keys = ['address', 'phone'];
$valueTranslations = \Yii::$app->config->getMultiplyTranslation($keys, 'ru-RU'); // return ['address' => 'Киев, Украина', 'phone' => '+111111111111'];
``` 
