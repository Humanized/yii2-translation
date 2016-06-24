<?php

/**
 * @link https://github.com/humanized/yii2-translation
 * @copyright Copyright (c) 2016 Humanized
 * @license http://www.yiiframework.com/license/
 */

namespace humanized\translation\components;

use yii\base\Action;

/**
 * Delete Action for controllers handling the Language GridView widget 
 * 
 */
class DeleteAction extends Action
{

    public function run($id)
    {
        Language::disable($id);
        exit;
    }

}
