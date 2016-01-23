<?php

namespace humanized\translation;

use yii\base\InvalidConfigException;
use codemix\localeurls\UrlManager as BaseUrlManager;
use humanized\translation\components\DataHelper;

class UrlManager extends BaseUrlManager {

    public function init()
    {
        $this->languages = array_map(function($x) {
            return strtolower($x);
        }, array_keys(DataHelper::getLanguageList()));

        $this->_defaultLanguage = strtolower(DataHelper::getDefaultLanguage());
        return parent::init();
    }

}
