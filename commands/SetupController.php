<?php

namespace humanized\translation\commands;

use humanized\clihelpers\controllers\Controller;
//use humanized\translation\models\Language;

/**
 * A CLI allowing Yii2 location managementS.
 * 
 * Supported commands:
 * 
 * > contact/import/countries
 * 
 * > contact/import/locations
 * 
 * 
 * @name Location Import CLI
 * @version 0.1
 * @author Jeffrey Geyssens <jeffrey@humanized.be>
 * @package yii2-contact
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
            $fn = \Yii::getAlias('@vendor') . '/humanized/yii2-contact/data/iso-639-1.csv';
        }

        //


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
                    $src = \Yii::$app->controller->module->params['languages'];
                    $record['is_enabled'] = in_array($record[1], $src);
                    $record['is_default'] = in_array($record[1], $src);
                });
    }

}
