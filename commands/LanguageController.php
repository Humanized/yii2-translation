<?php

namespace humanized\translation\commands;

use yii\console\Controller;
use \humanized\translation\models\Language;
use humanized\localehelpers\Language as LanguageHelper;

/**
 * 
 * CLI for dealing with site language administration.
 * 
 * Allows to set default site language and enable/disable languages 
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

    /**
     * 
     * Returns the default site language code, indicating clearly when not set
     * 
     * @return int
     */
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

    /**
     * 
     * @param type $locale
     * @return int
     */
    public function actionSetDefault($locale)
    {
        Language::setDefault($locale);
        return 0;
    }

    public function actionEnabled()
    {
        $this->stdout(implode(', ', Language::enabled()) . "\n");
        return 0;
    }

    /**
     * 
     * Enable a language by saving (primary) locale to database storage
     * 
     * @param string $locale - Locale to be enabled
     * @return int - status code
     */
    public function actionEnable($locale)
    {
        Language::enable($locale);
        return 0;
    }

    /**
     * 
     * Disable a language by removing locale from database storage
     * 
     * @param string $locale - Locale to be enabled
     * @return int - status code
     */
    public function actionDisable($locale)
    {
        Language::disable($locale);
        return 0;
    }

    public function actionPrimary()
    {
        $this->stdout(implode(', ', LanguageHelper::primary()) . "\n");
        return 0;
    }

    public function actionAvailable()
    {
        $this->stdout(implode(', ', LanguageHelper::available()) . "\n");
        return 0;
    }

}
