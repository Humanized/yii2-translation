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
    /*
     * =========================================================================
     *                          Module Configuration
     * =========================================================================
     */

    /**
     *  
     * @since 0.1
     * @var array<String>  An array with supported language codes
     * 
     * The enabled values will be stored in the database when running the setup command.
     * Values can be edited once database setup through the application GUI or CLI 
     * 
     */
    public $languages = ['en', 'nl', 'fr', 'de', 'es'];

    /**
     *  
     * @since 0.1
     * @var string  The default application fallback language
     * 
     * The value will be stored in the database when running the setup command.
     * Value can be edited once database setup through the application GUI or CLI 
     * 
     */
    public $fallback = 'en';

    /**
     *  
     * 
     */
    public function init()
    {
        parent::init();
        if (\Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'humanized\translation\commands';
        }
        $this->_loadConfiguration();
    }

    /**
     * Loads configuration values 
     */
    private function _loadConfiguration()
    {
        $this->params['fallback'] = $this->fallback;
        $this->params['languages'] = $this->languages;
    }

}
