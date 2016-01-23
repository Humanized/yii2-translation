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
        return parent::init();
        /*
          if ($this->enableLocaleUrls && $this->languages) {
          if (!$this->enablePrettyUrl) {
          throw new InvalidConfigException('Locale URL support requires enablePrettyUrl to be set to true.');
          }
          }
          $this->_defaultLanguage = Yii::$app->language;
          return parent::init();
         * 
         */
    }

}
