<?php

namespace humanized\translation\models;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use humanized\translation\models\Language;
use humanized\localehelpers\Language as LanguageHelper;

/**
 * LanguageSearch represents the model behind the search form about `humanized\translation\models\Language`.
 */
class LanguageSearch extends Language
{

    public $enableRegionalLocales = false;
    public $customPrimaryLocales = null;
    public $customAvailableLocales = null;
    private $_data;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'safe'],
            [['is_default'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public static function setupAvailableRecord($locale)
    {
        return self::setupDataRow($locale, -1);
    }

    public static function setupEnabledRecord($locale)
    {
        return self::setupDataRow($locale, 0);
    }

    public static function setupDataRow($locale, $status)
    {
        return ['id' => $locale, 'status' => $status, 'source' => LanguageHelper::native_label($locale), 'translation' => LanguageHelper::localised_label($locale)];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $this->_initData();
        //Do stuff with 
        $dataProvider = new ArrayDataProvider([
            'allModels' => $this->_data,
            'sort' => [
                'attributes' => ['id', 'status', 'source', 'translation'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }

    private function _initData()
    {
        //todo: cache this result (always)
        $default = self::getDefault();
        //Intialise Data 
        //First record is default application language
        $this->_data = [$default => self::setupDataRow($default, 1)];

        $this->_initEnabled();
        $this->_initAvailable();

        return $this->_data;
    }

    private function _initEnabled()
    {
        $enabled = self::enabled();
        //Next, the DB enabled languages
        foreach ($enabled as $locale) {
            if (!isset($this->_data[$locale])) {
                $this->_data[$locale] = self::setupEnabledRecord($locale);
            }
        }
    }

    private function _initAvailable()
    {
        $available = ($this->enableRegionalLocales ?
                        (isset($this->customAvailableLocales) && !empty($this->customAvailableLocales) ?
                                $this->customAvailableLocales :
                                LanguageHelper::available()) :
                        (isset($this->customPrimaryLocales) && !empty($this->customPrimaryLocales) ?
                                $this->customPrimaryLocales :
                                LanguageHelper::primary()));
        foreach ($available as $locale) {
            if (!isset($this->_data[$locale])) {
                $this->_data[$locale] = self::setupAvailableRecord($locale);
            }
        }
    }

}
