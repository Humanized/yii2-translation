<?php

namespace humanized\translation\models;

use Yii;

/**
 * This is the model class for table "translation".
 *
 * @property string $code
 * @property integer $is_enabled
 * @property integer $is_default
 *
 * @property Language $language
 */
class Translation extends \yii\db\ActiveRecord
{

    public $system_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['is_enabled', 'is_default'], 'integer'],
            [['code'], 'string', 'max' => 10],
            [['code'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['code' => 'code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => Yii::t('app', 'Code'),
            'is_enabled' => Yii::t('app', 'Is Enabled'),
            'is_default' => Yii::t('app', 'Is Default'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['code' => 'code']);
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
        return 'en';
        //return Language::findOne(['is_default' => TRUE])->code;
    }

    public static function enabled()
    {

        return self::findAll(['is_enabled' => TRUE]);
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

    public static function enable($language, $default = 0)
    {
        $ok = true;
        //Activate if language exits
        //Catch langauge error
        if (!self::is_activated($language)) {
            echo 'not activated' . "\n";
            self::activate($language, 0);
            //Jump out on false
        }

        $model = Translation::findOne(['code' => $language]);
        //Find model in translation table
        if (!self::is_enabled($language)) {

            $model->is_enabled = 1;
            $ok = $model->save();
        }
        if ($ok && $default == 1) {
            $model->is_default = 1;
            if ($model->save()) {
                $defaultModel = self::findOne(['is_default' => 1]);
                if (isset($defaultModel)) {
                    $defaultModel->is_default = 0;
                    $defaultModel->save();
                }
            }
        }
        return $ok;
    }

    //


    public static function disable($language)
    {
        //Find model in translation table
        if (self::is_enabled($language)) {
            $model = Translation::findOne(['code' => $language]);
            if ($model->is_default != 1) {
                $model->is_enabled = 0;
                return $model->save();
            }
        }
        //
        return FALSE;
    }

    public static function activate($language, $enable = 1, $default = 0)
    {
        if (!self::is_activated($language)) {
            $translationAttributes = [
                'code' => strtoupper($language),
                'is_enabled' => $enable,
                'is_default' => $default,
            ];
            $translation = new Translation();
            $translation->setAttributes($translationAttributes);
            return $translation->save();
        }
        return FALSE;
    }

    public static function disactivate($language)
    {
        $model = self::findOne(['code' => strtoupper($language)]);
        if (isset($model) && !$model->is_default) {
            $model->delete();
        }
    }

    public static function is_activated($language)
    {
        $activated = self::activated();

        return in_array(strtoupper($language), array_map(function($l) {

                    return $l->code;
                }, $activated));
    }

    public static function activated()
    {

        return self::find()->all();
    }

}
