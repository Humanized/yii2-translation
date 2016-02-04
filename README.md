# Yii2-Translation - README
[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](http://www.yiiframework.com/)

Provides various interfaces to deal with routine tasks dealing with translation management.

> This extension is under heavy development and requires the use of Yii framework version 2.0.7
> This version of the framework is currently in active development  

> This module should be considered highly unstable and it's use is discouraged until further notice (really)


> Version 0.1 Release notes: 


## Features

This module aims to be a clean, modular module to deal with database translation tasks.


## Installation

### Install Using Composer

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require humanized/yii2-translation "dev-master"
```

or add

```
"humanized/yii2-translation": "dev-master"
```

to the ```require``` section of your `composer.json` file.


### Add Module to Configuration

Add following lines to the configuration file:

```php
'modules' => [
    'translation' => [
        'class' => 'humanized\translation\Module',
    ],
],
```

For full instructions how to configure this module, check the [CONFIG](CONFIG.md)-file.

### Run Migrations 

```bash
$ php yii migrate/up --migrationPath=@vendor/humanized/yii2-translation/migrations
```

For full instructions on how to use this module, once configured, check the [USAGE](USAGE.md)-file.