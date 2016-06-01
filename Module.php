<?php

namespace humanized\translation;

/**
 * 
 * Yii2 Multi-Lingual Site Module.
 * 
 * Provides interfaces to deal with: 
 * - Enable/disable languages using database storage (GUI,CLI)
 * - Set default application language using database storage (GUI,CLI)
 * 
 * Provides various flexible language selection widgets:
 * - Inline list
 * - Dropdown list
 * - Select2 Dropdownlist
 * 
 * @name Yii2 Translation Module Class 
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
