<?php

namespace humanized\translation\components;

use humanized\translation\models\Language;

class UrlManager extends \codemix\localeurls\UrlManager
{

    public function init()
    {
        \Yii::$app->language = Language::getDefault();
        $this->languages = Language::enabled();
        parent::init();
    }

}
