DB Provider
===========
Db provider for `ConfigurationTranslation` component

Configuration
-------------
Migrate
```php
./yii migrate --migrationPath="@ymaker/configuration/translation/migrations"
```
and configure provider
```php
'provider' => [
    'class' => '\ymaker\configuration\providers\translation\DbProvider',
    'tableName' => '{{%config}}'
]

```
Field Description
-----------------

|Field             |Type                              |Default                          |Description          |
|:----------------:|:--------------------------------:|:-------------------------------:|:--------------------|
|`$tableName`      |`string`                          |`{{%configuration_translation}}` |table name           |
|`$keyColumn`      |`string`                          |`key`                            |key column name      |
|`$valueColumn`    |`string`                          |`value`                          |value column name    |
|`$languageColumn` |`string`                          |`language`                       |language column name |
|`$db`             |`string|array|yii\db\Connection`  |`db`                             |database connection  |

Usage
-----
```php
$isSet = \Yii::$app->config->set('address', 'Kiev, Ukraine');
$value = \Yii::$app->config->get('address'); // return 'Kiev, Ukraine';
$isSetTranslation = \Yii::$app->config->set('address', 'Киев, Украина' 'ru-RU');
$valueTranslation = \Yii::$app->config->getTranslation('address', 'ru-RU'); // return 'Киев, Украина';
```
