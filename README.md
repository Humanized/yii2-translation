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


### Run Migrations 

```bash
$ php yii migrate/up --migrationPath=@vendor/humanized/yii2-translation/migrations
```


### Add Module to Configuration

Add following lines to the configuration file:

```php
'modules' => [
    'translation' => [
        'class' => 'humanized\translation\Module',
    ],
],
```

These lines allow access to the various interfaces provided by the module. Here, the chosen module-name is translation, as such the various routes will be available at translation/controller-id/action-id, though any module-name can be chosen.





Once a default language has been setup, 


Further, the module provides a wrapper for the UrlManager extensions provided by [Codemix Yii2-LocaleUrls package](https://github.com/codemix/yii2-localeurls), which loads the enabled languages automatically.

```php
'components' => [
..
        // Languages enabled populated through database storage
        // Further configuration options available at https://github.com/codemix/yii2-localeurls 
        'urlManager' => [
            'class' => 'humanized\translation\components\UrlManager',
            'enablePrettyUrl' => true, 
            'showScriptName' => false, // Only considered when enablePrettyUrl is set to true
        ],
..
],


For full instructions on how to use this module, once configured, check the [USAGE](USAGE.md)-file.