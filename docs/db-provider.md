DB Provider
===========
Db provider for `Configuration` component

Configuration
-------------
Migrate
```php
./yii migrate --migrationPath="@ymaker/configuration/migrations"
```
and configure provider
```php
'provider' => [
    'class' => '\ymaker\configuration\providers\DbProvider',
    'tableName' => '{{%config}}'
]

```
Field Description
-----------------

|Field         |Type                              |Default             |Description        |
|:------------:|:--------------------------------:|:------------------:|:------------------|
|`$tableName`  |`string`                          |`{{%configuration}}`|table name         |
|`$keyColumn`  |`string`                          |`key`               |key column name    |
|`$valueColumn`|`string`                          |`value`             |value column name  |
|`$db`         |`string|array|yii\db\Connection`  |`db`                |database connection|

Usage
-----
```php
$isSet = \Yii::$app->config->set('commission', '10');
$value = \Yii::$app->config->get('commission'); // return '10';
$isSet = \Yii::$app->config->set('address', 'Kiev, Ukraine');

$valus = \Yii::$app->config->getMultiply(['commission', 'address']); // return ['commision' => '10', 'address' => 'Kiev, Ukraine'];

```
