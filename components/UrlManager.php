<?php

namespace humanized\translation\components;

use codemix\localeurls\UrlManager as BaseUrlManager;
use humanized\translation\models\Language;

class UrlManager extends BaseUrlManager
{

    public function init()
    {
        $this->languages = Language::enabled();
        parent::init();
    }

}
