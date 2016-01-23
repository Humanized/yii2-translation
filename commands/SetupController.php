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
                    $default = \Yii::$app->controller->module->params['default'];

                    $record['is_enabled'] = in_array(strtolower($record['code']), array_map(function($val) {
                                        return strtolower($val);
                                    }, $languages)) ? 1 : 0;
                    $record['is_default'] = strtolower($record['code']) == strtolower($default) ? 1 : 0;
                });
    }

}
