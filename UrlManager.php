<?php

namespace humanized\translation;

use yii\base\InvalidConfigException;
use codemix\localeurls\UrlManager as BaseUrlManager;
use humanized\translation\models\Language;

class UrlManager extends BaseUrlManager {

    public function init()
    {

        $this->languages = array_map(function($model) {
            return $model->code;
        }, Language::enabled());

        if (parent::init()) {
            $default = Language::fallback();
            if (isset($default)) {
                $this->_defaultLanguage = strtolower($default->code);
            }
        }
    }

}
