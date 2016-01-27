<?php

namespace humanized\translation\components;

use yii\base\Widget;
use yii\helpers\Html;
use humanized\translation\models\Language;

/**
 * LanguagePicker Widget for Yii2 - By Humanized
 * 
 * This widget allows the user to set the application using the configuration provided by the Module. 
 * 
 * @name Yii2 LanguagePicker Widget Class
 * @version 0.1 
 * @author Jeffrey Geyssens <jeffrey@humanized.be>
 * @package yii2-translation
 */
class LanguagePicker extends Widget {

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return 'Current Language: <b>' . strtoupper(Language::current()) . '</b><br>';
    }

}
