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

Content
-------
1. [Configuration](docs/README.MD)
2. [Configuration Translation](docs/translation/README.MD)

Create own provider
--------------------
1. Create Class for provider
2. Implement `\ymaker\configuration\ProviderInterface`
3. Change in the configuration file on your provider
