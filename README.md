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


### Edit Configuration File

Add following lines to the configuration file:

```php
'modules' => [
    'translation' => [
        'class' => 'humanized\translation\Module',
    ],
],
```

Adding these lines allows access to the various interfaces provided by the module. 
Here, the chosen module-name is translation, as such the various routes will be available at translation/controller-id/action-id, though any module-name can be chosen.

To setup the default language, add the following line to the configuration file


```php
return [
..
    'language'=> \humanized\translation\models\Language::getDefault(),
..
]
```


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
```

Once configured, one or multiple languages should be enabled using the various interfaces provided by the module. To get up-and-running quickly, an example is given to enable some languages using the CLI tool provided by the system:

```bash
$ php yii translation/language/enable en
$ php yii translation/language/enable fr
$ php yii translation/language/enable nl
$ php yii translation/language/set-default en 
```

Above mentioned lines enables the English, French and Dutch language ands sets English as the default language

For full instructions on how to use the fully-configured module, check the [USAGE](USAGE.md)-file.
