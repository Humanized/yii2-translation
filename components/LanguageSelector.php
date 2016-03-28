<?php

namespace humanized\translation\components;

use yii\base\Widget;
use yii\helpers\Html;
use humanized\translation\models\Translation;

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
class LanguageSelector extends Widget {

    public $selectionTemplate = '{}{}{}';
    public $separator = ' | ';

    public function init()
    {
        parent::init();
    }

    public function run()
    {

        return implode($this->separator, $this->_getUrls());
    }

    private function _getUrls()
    {
        $route = \Yii::$app->controller->route;
        $urls = [];
        foreach (Translation::enabled() as $language) {
            $code = $language->code;
            if (strtoupper(Translation::current()) != strtoupper($code)) {
                $urls[] = Html::a($language->code, ["/$route", 'language' => $language->code]);
            }
        }
        return $urls;
    }

}
