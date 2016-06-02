<?php

namespace humanized\translation\components;

use codemix\localeurls\UrlManager as BaseUrlManager;
use humanized\translation\models\Language;

class UrlManager extends BaseUrlManager
{

    public function init()
    {
    //    \Yii::$app->language = Language::getDefault();
        $this->languages = Language::enabled();
        parent::init();
    }

}
