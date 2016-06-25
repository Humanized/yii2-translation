<?php

/**
 * @link https://github.com/Humanized/yii2-translation
 * @copyright Copyright (c) 2016 Humanized BV Comm GCV
 * @license https://github.com/Humanized/yii2-translation/LICENCE.md
 */

namespace humanized\translation;

/**
 * 
 * Yii2 Site Translation Module
 * 
 * Provides various interfaces to deal with routine tasks dealing with site translation management.
 * 
 * - Enable/disable languages using database storage (GUI,CLI)
 * - Set default application language using database storage (GUI,CLI)
 * 
 * Provides various flexible language selection widgets:
 * - Inline list
 * - Bootstrap Dropdown button
 * - Bootstrap Dropdown list
 * 
 * @name Yii2 Site Translation Module Class 
 * @version 0.1 
 * @author Jeffrey Geyssens <jeffrey@humanized.be>
 * @package yii2-translation
 */
class Module extends \yii\base\Module
{

    public function init()
    {
        parent::init();
        if (\Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'humanized\translation\commands';
        }
    }

}
