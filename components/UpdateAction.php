<?php

/**
 * @link https://github.com/humanized/yii2-translation
 * @copyright Copyright (c) 2016 Humanized
 * @license http://www.yiiframework.com/license/
 */

namespace humanized\translation\components;

use humanized\translation\models\Language;

/**
 * Update Action for controllers handling the Language Grid 
 * 
 */
class UpdateAction extends \yii\base\Action
{

    public function run($id)
    {
        Language::setDefault($id);
        exit;
    }

}
