<?php

namespace humanized\translation;

/**
 * Translation Module for Yii2 - By Humanized
 * This module wraps several mechanisms employed in-house dealing with routine tasks related to translatable content.
 * Particularly, emphasis is placed on providing an interface to deal with translations using database storage.
 * 
 * This module provides extends and depends on yii2-localeurls by codemix . 
 * 
 * 
 * @name Yii2 Translation Module Class 
 * @version 0.1 
 * @author Jeffrey Geyssens <jeffrey@humanized.be>
 * @package yii2-translation
 */
class Module extends \yii\base\Module {

    /**
     *  
     * 
     * @var array<String>  
     */
    public $languages = ['en', 'nl', 'fr', 'de', 'es'];
    public $default = 'en';
    public $localeUrlsConfig = [];

    public function init()
    {
        parent::init();
        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'humanized\translation\commands';
        }
        $this->_setupDbDefaults();
        $this->_setupLocaleUrl();
    }

    private function _setupDbDefaults()
    {
        $this->params['default'] = $this->default;
        $this->params['languages'] = $this->languages;
    }

    private function _setupLocaleUrl()
    {
        $this->params['localeUrlsConfig'] = $this->localeUrlsConfig;
    }

}
