<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace humanized\translation\controllers;

use Yii;
use humanized\translation\models\Translation;
use humanized\translation\models\TranslationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class AdminController extends Controller
{

    public $array = [
        ["source_id" => "es",
            "language_id" => "es",
            "name" => "español"],
        ["source_id" => "es",
            "language_id" => "en",
            "name" => "Spanish"],
        ["source_id" => "bg",
            "language_id" => "bg",
            "name" => "българскиl"],
        ["source_id" => "bg",
            "language_id" => "en",
            "name" => "Bulgarian"],
        ["source_id" => "cs",
            "language_id" => "cs",
            "name" => "čeština"],
        ["source_id" => "cs",
            "language_id" => "en",
            "name" => "Czech"],
        ["source_id" => "da",
            "language_id" => "da",
            "name" => "dansk"],
        ["source_id" => "da",
            "language_id" => "en",
            "name" => "Danish"],
        ["source_id" => "de",
            "language_id" => "de",
            "name" => "Deutsch"],
        ["source_id" => "de",
            "language_id" => "en",
            "name" => "German"],
        ["source_id" => "et",
            "language_id" => "et",
            "name" => "eesti keel"],
        ["source_id" => "et",
            "language_id" => "en",
            "name" => "Estonian"],
        ["source_id" => "el",
            "language_id" => "el",
            "name" => "ελληνικά"],
        ["source_id" => "el",
            "language_id" => "en",
            "name" => "Greek"],
        ["source_id" => "en",
            "language_id" => "en",
            "name" => "English"],
        ["source_id" => "fr",
            "language_id" => "fr",
            "name" => "français"],
        ["source_id" => "fr",
            "language_id" => "en",
            "name" => "French"],
        ["source_id" => "ga",
            "language_id" => "ga",
            "name" => "Gaeilge"],
        ["source_id" => "ga",
            "language_id" => "en",
            "name" => "Irish"],
        ["source_id" => "hr",
            "language_id" => "hr",
            "name" => "hrvatski"],
        ["source_id" => "hr",
            "language_id" => "en",
            "name" => "Croatian"],
        ["source_id" => "it",
            "language_id" => "it",
            "name" => "italiano"],
        ["source_id" => "it",
            "language_id" => "en",
            "name" => "Italian"],
        ["source_id" => "lv",
            "language_id" => "lv",
            "name" => "latviešu"],
        ["source_id" => "lv",
            "language_id" => "en",
            "name" => "Latvian"],
        ["source_id" => "lt",
            "language_id" => "lt",
            "name" => "lietuvių kalba"],
        ["source_id" => "lt",
            "language_id" => "en",
            "name" => "Lithuanian"],
        ["source_id" => "hu",
            "language_id" => "hu",
            "name" => "magyar"],
        ["source_id" => "hu",
            "language_id" => "en",
            "name" => "Hungarian"],
        ["source_id" => "mt",
            "language_id" => "mt",
            "name" => "Malti"],
        ["source_id" => "mt",
            "language_id" => "en",
            "name" => "Maltese"],
        ["source_id" => "nl",
            "language_id" => "nl",
            "name" => "Nederlands"],
        ["source_id" => "nl",
            "language_id" => "en",
            "name" => "Dutch"],
        ["source_id" => "pl",
            "language_id" => "pl",
            "name" => "polski"],
        ["source_id" => "pl",
            "language_id" => "en",
            "name" => "Polish"],
        ["source_id" => "pt",
            "language_id" => "pt",
            "name" => "português"],
        ["source_id" => "pt",
            "language_id" => "en",
            "name" => "Portuguese"],
        ["source_id" => "ro",
            "language_id" => "ro",
            "name" => "română"],
        ["source_id" => "ro",
            "language_id" => "en",
            "name" => "Romanian"],
        ["source_id" => "sk",
            "language_id" => "sk",
            "name" => "slovenčina"],
        ["source_id" => "sk",
            "language_id" => "en",
            "name" => "Slovak"],
        ["source_id" => "sl",
            "language_id" => "sl",
            "name" => "slovenščina"],
        ["source_id" => "sl",
            "language_id" => "en",
            "name" => "Slovene"],
        ["source_id" => "fi",
            "language_id" => "fi",
            "name" => "suomi"],
        ["source_id" => "fi",
            "language_id" => "en",
            "name" => "Finnish"],
        ["source_id" => "sv",
            "language_id" => "sv",
            "name" => "svenska"],
        ["source_id" => "sv",
            "language_id" => "en",
            "name" => "Swedish"],
        ["source_id" => "is",
            "language_id" => "is",
            "name" => "íslenska"],
        ["source_id" => "is",
            "language_id" => "en",
            "name" => "Icelandic"],
        ["source_id" => "mk",
            "language_id" => "mk",
            "name" => "македонски"],
        ["source_id" => "mk",
            "language_id" => "en",
            "name" => "Macedonian"],
        ["source_id" => "no",
            "language_id" => "no",
            "name" => "norsk"],
        ["source_id" => "no",
            "language_id" => "en",
            "name" => "Norwegian"],
        ["source_id" => "tr",
            "language_id" => "tr",
            "name" => "türkçe"],
        ["source_id" => "tr",
            "language_id" => "en",
            "name" => "Turkish"],
    ];

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Language models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new TranslationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Language model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!Translation::is_enabled($id)) {
            Translation::enable($id);
        } else {
            Translation::disable($id);
        }
        $this->redirect('index');
    }

    /**
     * Displays a single Language model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Language model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Language the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Translation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
