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
 * @property Translation $translation
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiteLanguages()
    {
        return $this->hasOne(Translation::className(), ['code' => 'code']);
    }


}
