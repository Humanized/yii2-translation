<?php

namespace humanized\translation\models;

/**
 * This is the model class for table "language".
 *
 * @property string $code
 * @property integer $is_default
 * @property integer $is_enabled
 * @property string $system_name
 *
 * @property LanguageTranslation[] $translations
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
            [['code', 'system_name'], 'required'],
            [['code'], 'string', 'max' => 10],
            [['system_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'system_name' => 'System Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(LanguageTranslation::className(), ['source_id' => 'code']);
    }

    public function switchEnable()
    {
        $this->is_enabled = ($this->is_enabled == FALSE ? 1 : 0);
        $this->save();
    }

    /* =========================================================================
     *                          Static Helper Functions 
     * =========================================================================
     */

    /**
     * 
     * @return type
     */
    public static function fallback()
    {
        return Language::findOne(['is_default' => TRUE])->code;
    }

    public static function enabled()
    {
        return Language::findAll(['is_enabled' => TRUE]);
    }

    public static function current()
    {
        return \Yii::$app->language;
    }

    public static function set($language)
    {
        if (self::is_enabled($language)) {
            \Yii::$app->language = $language;
            return TRUE;
        }
        return FALSE;
    }

    public static function is_enabled($language)
    {
        return in_array(strtoupper($language), array_map(function($l) {
                    return $l->code;
                }, self::enabled()));
    }

}
