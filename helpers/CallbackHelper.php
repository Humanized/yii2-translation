<?php

namespace humanized\translation\helpers;

use Yii;
use yii\bootstrap\Html;
use humanized\translation\models\Language;

class CallbackHelper
{

    /**
     * 
     * @param Language $model
     * @return string
     */
    public static function codeColumnFn($model)
    {
        return strtoupper($model->id);
    }

    /**
     * 
     * @param Language $model
     * @return string
     */
    public static function defaultColumnFn($model)
    {
        return $model->is_default;
    }

    /**
     * 
     * @param Language $model
     * @return string
     */
    public static function sourceColumnFn($model)
    {
        return $model->source;
    }

    /**
     * 
     * @param Language $model
     * @return string
     */
    public static function translationColumnFn($model)
    {
        return $model->translation;
    }

    /**
     * 
     * @param type $url
     * @param Language $model
     * @param type $key
     */
    public static function updateButtonFn($url, $model, $key)
    {
        $options = array_merge([
            'title' => Yii::t('yii', 'Update'),
            'aria-label' => Yii::t('yii', 'Update'),
            'data-pjax' => '0',
                ], []);
        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
    }

    /**
     * 
     * @param type $url
     * @param Laanguage $model
     * @param type $key
     */
    public static function deleteButtonFn($url, $model, $key)
    {
        $options = array_merge([
            'title' => Yii::t('yii', 'Delete'),
            'aria-label' => Yii::t('yii', 'Delete'),
            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
            'data-pjax' => '0',
                ], []);
        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
    }

}
