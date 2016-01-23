<?php

namespace humanized\translation\models;

use humanized\translation\models\Language;

/**
 * This is the model class for table "language_translation".
 *
 * @property integer $id
 * @property string $source_id
 * @property string $language_id
 * @property string $name
 *
 * @property Language $source
 * @property Language $language
 */
class LanguageTranslation extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'language_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['source_id', 'language_id', 'name'], 'required'],
            [['source_id', 'language_id'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 255],
            [['source_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['source_id' => 'code']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'source_id' => 'Source ID',
            'language_id' => 'Language ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(Language::className(), ['code' => 'source_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['code' => 'language_id']);
    }

}
