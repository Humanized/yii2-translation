# Yii2-Translation - README
[![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](http://www.yiiframework.com/)

Provides various interfaces to deal with routine tasks dealing with translation management.


## Features

 Yii2 Multi-Lingual Site Module.
 
 Provides interfaces to deal with: 
 * Enable/disable languages using database storage (GUI,CLI)
 * Set default application language using database storage (GUI,CLI)
 
 Provides various flexible language selection widgets:
 * Inline list 


## Installation

### Install Using Composer

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require humanized/yii2-translation "*"
```

or add

```
"humanized/yii2-translation": "*"
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