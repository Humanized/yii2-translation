<?php

/**
 * @link https://github.com/humanized/yii2-translation
 * @copyright Copyright (c) 2016 Humanized
 * @license http://www.yiiframework.com/license/
 */

namespace humanized\translation\components;

use yii\base\Action;

/**
 * Create Action for controllers handling the Language GridView widget 
 * 
 */
class CreateAction extends Action
{

    public function run($id)
    {
        Language::enable($id);
        exit;
    }

}
