<?php

namespace humanized\translation\helpers;

class TemplateHelper
{

    public static function explode($template)
    {
        if (!preg_match_all('/\\{([\w\-\/]+)\\}/', $template, $matches)) {
            throw new \yii\base\InvalidConfigException('TranslationGridView Configuration Error (template): Could not parse template string');
        }
        return $matches[1];
    }

}
