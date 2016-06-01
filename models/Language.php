<?php

namespace humanized\translation\models;

use Yii;
use Locale;

/**
 * This is the model class for table "language".
 *
 * @property string $id
 * @property integer $is_default
 */
class Language extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'unique'],
            [['is_default'], 'integer'],
            [['id'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'is_default' => Yii::t('app', 'Is Default'),
        ];
    }

    public function nativeLabel()
    {
        return $this->label($this->id);
    }

    public function localisedLabel()
    {
        return $this->label(Yii::$app->language);
    }

    public function label($locale)
    {
        return Locale::getDisplayLanguage($this->id, $locale);
    }

    public static function enable($locale)
    {
        $code = Locale::getPrimaryLanguage($locale);
        if (isset($code)) {
            $language = new Language(['id' => $locale]);
            return $language->save();
        }
        return false;
    }

    public static function getDefault()
    {
        $model = Language::findOne(['is_default' => TRUE]);
        if (isset($model)) {
            return $model->id;
        }
        return NULL;
    }

    public static function setDefault($locale)
    {
        $code = Locale::getPrimaryLanguage($locale);
        if (isset($code)) {
            $oldDefault = Language::findOne(['is_default' => TRUE]);
            $newDefault = Language::findOne(['id' => $code]);

            if (isset($newDefault)) {
                $newDefault->is_default = TRUE;
                $newDefault->save();
                $oldDefault->is_default = FALSE;
                $oldDefault->save();
                return TRUE;
            }
        }
        return FALSE;
    }

}
