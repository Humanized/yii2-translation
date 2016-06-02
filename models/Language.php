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

    public static function enabled($fn = NULL)
    {
        $fnEnabled = function($model) use ($fn) {
            if (isset($fn)) {
                return $fn($model['id']);
            }
            return $model['id'];
        };
        return array_map($fnEnabled, Language::find()->asArray()->all());
    }

    public static function enable($locale)
    {
        $code = Locale::getPrimaryLanguage($locale);
        if (isset($code)) {
            $language = new Language(['id' => $locale]);
            return $language->save();
        }
        return FALSE;
    }

    public static function disable($locale)
    {
        $code = Locale::getPrimaryLanguage($locale);
        if (isset($code)) {
            return Language::deleteAll(['id' => $code]);
        }
        return FALSE;
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
        $pass = FALSE;
        if (isset($code)) {
            $oldDefault = Language::findOne(['is_default' => TRUE]);
            $newDefault = Language::findOne(['id' => $code]);

            //Set new default language if required
            if (isset($newDefault)) {
                $newDefault->is_default = 1;
                $pass = $newDefault->save();
            }
            //Unset old default language if required
            if ($pass && isset($oldDefault) && $newDefault->id != $oldDefault->id) {
                $oldDefault->is_default = 0;
                $oldDefault->save();
            }
        }
        return $pass;
    }

}
