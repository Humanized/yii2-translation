<?php

namespace humanized\translation\commands;

use humanized\clihelpers\controllers\Controller;

//use humanized\translation\models\Language;

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
            $fn = \Yii::getAlias('@vendor') . '/humanized/yii2-contact/data/languages.csv';
        }
        $attributes = [
            0 => 'code',
            1 => 'system_name'
        ];
        $config = [
            'fileName' => $fn,
            'delimeter' => $delimiter,
            'saveModel' => Language::className(),
            'attributeMap' => $attributes
        ];
        return $this->importCSV($config, function(&$record) {
                    $languages = \Yii::$app->controller->module->params['languages'];
                    $default = \Yii::$app->controller->module->params['default'];
                    $record['is_enabled'] = in_array($record[1], $languages);
                    $record['is_default'] = $record[1] == $default;
                });
    }

}
