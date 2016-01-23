<?php

namespace humanized\translation\components;

use \humanized\translation\models\Language;
use yii\helpers\ArrayHelper;

/**
 * A collection of static helper functions to implement the user management 
 */
class DataHelper {

    public static function getLanguageList()
    {
        return ArrayHelper::map(Language::findAll(['is_enabled' => TRUE]), 'code', 'system_name');
    }

    public static function getDefaultLanguage()
    {
        return Language::findOne(['is_default' => TRUE]);
    }

}
