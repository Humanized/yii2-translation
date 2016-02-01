<?php

namespace humanized\translation\commands;

use humanized\clihelpers\controllers\Controller;
use humanized\translation\models\Language;

/**
 * A CLI allowing Yii2 location managementS.
 * 
 * Supported commands:
 * 
 * > <module-name>/setup/data 
 * 
 * 
 * 
 * @name Translation Module Setup CLI
 * @version 0.1
 * @author Jeffrey Geyssens <jeffrey@humanized.be>
 * @package yii2-translation
 * 
 * 
 * 
 */
class SetupController extends Controller {

    /**
     * 
     * @param string $language - language code to enable
     */
    public function actionEnable($language)
    {
        if (!Language::is_enabled($language)) {
            $model = $this->_getModel($language);
            if (isset($model)) {
                $model->switchEnable();
                $this->_msg = $language . ' - enabled';
            } else {
                $this->_msg = $language . ' does not exist in database';
                $this->_exitCode = '102';
            }
        } else {
            $this->_msg = $language . ' already enabled';
            $this->_exitCode = '101';
        }
        return $this->_exitCode;
    }

    /**
     * 
     * @param string $language - language code to disable
     */
    public function actionDisable($language)
    {


        if (Language::is_enabled($language)) {
            $model = $this->_getModel($language);
            if (isset($model)) {
                $model->switchEnable();
                $this->_msg = $language . ' - disabled';
            } else {
                $this->_msg = $language . ' does not exist in database';
                $this->_exitCode = '202';
            }
        } else {
            $this->_msg = $language . ' already disabled';
            $this->_exitCode = '201';
        }
        return $this->_exitCode;
    }

    /**
     * 
     * @param string $language - language code to be set as default application fallback
     */
    public function actionSetFallback($language)
    {
        $model = $this->_getModel($language);
        if (isset($model)) {
            
        }
        return $this->_exitCode;
    }

    private function _getModel($language)
    {
        $model = Language::findOne(['code' => $language]);
        if (!isset($model)) {
            $this->_msg = $language . ' does not exist in the database';
            $this->_exitCode = 501;
            return NULL;
        }
        return $model;
    }

    /**
     * 
     * @param string $fn Absolute Path to Import Filename, if not set, the system will use a default import file loaded in the data folder in the root of the extension
     * @param type $delimiter
     * @return type
     */
    public function actionData($fn = NULL, $delimiter = ',')
    {
        //Set filename to default location
        if (!isset($fn)) {
            $fn = \Yii::getAlias('@vendor') . '/humanized/yii2-translation/data/languages.csv';
        }
        $attributes = [
            0 => 'code',
            1 => 'system_name'
        ];
        $config = [
            'fileName' => $fn,
            'delimiter' => $delimiter,
            'saveModel' => Language::className(),
            'attributeMap' => $attributes
        ];
        return $this->importCSV($config, function(&$record, $config) {
                    $languages = \Yii::$app->controller->module->params['languages'];
                    $default = \Yii::$app->controller->module->params['fallback'];

                    $record['is_enabled'] = in_array(strtolower($record['code']), array_map(function($val) {
                                        return strtolower($val);
                                    }, $languages)) ? 1 : 0;
                    $record['is_default'] = strtolower($record['code']) == strtolower($default) ? 1 : 0;
                });
    }

}
