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
            'id' => Yii::t('app', 'Language Code'),
            'is_default' => Yii::t('app', 'Is Default'),
            'source' => Yii::t('app', 'Name (Native)'),
            'translation' => Yii::t('app', 'Name (Local)'),
        ];
    }

    /*
     * 
     * ========================================================================
     *                  Operations on a model instance
     * ========================================================================
     * 
     */

    /**
     * 
     * @return string The native language display name
     */
    public function getSource()
    {
        return $this->label($this->id);
    }

    /**
     * 
     * @return string The language display name in the current application langauage 
     */
    public function getTranslation()
    {
        return $this->label(Yii::$app->language);
    }

    /**
     * 
     * @return string
     */
    public function label($locale)
    {
        return Locale::getDisplayLanguage($this->id, $locale);
    }

    /**
     * 
     * @return boolean
     */
    public function isDefault()
    {
        return $this->is_default != 0;
    }

    /*
     * 
     * ========================================================================
     *                  Operations on a single model instance
     * ========================================================================
     * 
     */

    public static function isEnabled($locale)
    {
        return in_array($locale, self::enabled());
    }

    /**
     * 
     * @param function($model) $fn callback to be  
     * @return type
     */
    public static function enabled($fn = NULL)
    {
        $fnEnabled = function($model) use ($fn) {
            if (isset($fn)) {
                return $fn($model['id']);
            }
            return $model['id'];
        };
        try {
            return array_map($fnEnabled, Language::find()->asArray()->all());
        } catch (\Exception $ex) {
            return [];
        }
    }

    /**
     * 
     * @param type $locale
     * @return boolean
     */
    public static function enable($locale)
    {
        $code = Locale::getPrimaryLanguage($locale);
        if (isset($code)) {
            $language = new Language(['id' => $locale]);
            try {
                if (!$language->save()) {
                    return false;
                }
                if (self::getDefault() === NULL) {
                    return self::setDefault($locale);
                }
                return true;
            } catch (\Exception $ex) {
                
            }
        }
        return false;
    }

    /**
     * 
     * @param type $locale
     * @return boolean
     */
    public static function disable($locale)
    {
        $code = Locale::getPrimaryLanguage($locale);
        if (isset($code) && $code != self::getDefault()) {
            return Language::deleteAll(['id' => $code]);
        }
        return FALSE;
    }

    /**
     * 
     * @return string(2)|NULL
     */
    public static function getDefault()
    {
        $model = Language::findOne(['is_default' => TRUE]);
        if (isset($model)) {
            return $model->id;
        }
        return NULL;
    }

    /**
     * 
     * @param type $locale
     * @return boolean
     */
    public static function setDefault($locale)
    {
        $code = Locale::getPrimaryLanguage($locale);
        $pass = FALSE;
        if (isset($code)) {
            $oldDefault = self::findOne(['is_default' => TRUE]);
            $newDefault = self::findOne(['id' => $code]);

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
