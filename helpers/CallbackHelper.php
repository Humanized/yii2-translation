<?php

namespace humanized\translation\helpers;

use Yii;
use yii\bootstrap\Html;
use humanized\translation\models\Language;
use humanized\localehelpers\Language as LanguageHelper;

class CallbackHelper
{

    /**
     * 
     * @param Language $model
     * @return string
     */
    public static function idColumnFn($model)
    {
        return strtoupper($model['id']);
    }

    /**
     * 
     * @param Language $model
     * @return string
     */
    public static function statusColumnFn($model)
    {
        return $model['status'];
    }

    /**
     * 
     * @param Language $model
     * @return string
     */
    public static function sourceColumnFn($model)
    {
        return $model['source'];
    }

    /**
     * 
     * @param Language $model
     * @return string
     */
    public static function translationColumnFn($model)
    {

        return $model['translation'];

        // return LanguageHelper::localised_label($model["id"]);
    }

    /**
     * 
     * @param type $url
     * @param Language $model
     * @param type $key
     */
    public static function updateButtonFn($url, $model, $key)
    {

        $options = [
            'class' => 'set-default-language-button',
            'data-pjax' => 'language-grid',
            'url' => \yii\helpers\Url::to(['set-default-language', 'id' => $model['id']]),
            'title' => Yii::t('yii', 'Update'),
            'aria-label' => Yii::t('yii', 'Update'),
            'style' => 'cursor:pointer'
        ];
        return $model['status'] == 0 ? Html::a('<span class="glyphicon glyphicon-asterisk"></span>', false, $options) : null;
    }

    /**
     * 
     * @param type $url
     * @param Language $model
     * @param type $key
     */
    public static function deleteButtonFn($url, $model, $key)
    {

        $glyphSuffix = 'ok';
        $actionPrefix = 'enable';
        if ($model['status'] == 0) {
            $glyphSuffix = 'remove';
            $actionPrefix = 'disable';
        }

        $options = [
            'class' => $actionPrefix . '-language-button',
            'data-pjax' => 'language-grid',
            'url' => \yii\helpers\Url::to([$actionPrefix . '-language', 'id' => $model['id']]),
            'title' => Yii::t('yii', 'Delete'),
            'aria-label' => Yii::t('yii', 'Delete'),
            'style' => 'cursor:pointer'
        ];
        return Html::a('<span class="glyphicon glyphicon-' . $glyphSuffix . '"></span>', false, $options);
    }

    public static function fnRowOptions($model, $key, $index, $grid)
    {
        return ['style' => 'color:green; background-color:green;'];
    }

}
