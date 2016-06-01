<?php

namespace humanized\translation\commands;

use yii\console\Controller;
use \humanized\translation\models\Language;

/**
 * 
 * 
 * 
 * 
 * @name Translation Module Administration CLI
 * @version 0.1
 * @author Jeffrey Geyssens <jeffrey@humanized.be>
 * @package yii2-translation
 * 
 * 
 * 
 */
class LanguageController extends Controller
{

    public function actionEnable($locale)
    {
        Language::enable($locale);
        return 0;
    }

    public function actionSetDefault($locale)
    {
        Language::setDefault($locale);
        return 0;
    }

    public function actionGetDefault()
    {
        $out = Language::getDefault();
        if (isset($out)) {
            $this->stdout($out . "\n");
            return 0;
        }
        $this->stderr('Default language is not set' . "\n");
        return 1;
    }

}
