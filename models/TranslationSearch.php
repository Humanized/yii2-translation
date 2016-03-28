<?php

namespace humanized\translation\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use humanized\translation\models\Translation;

/**
 * LanguageSearch represents the model behind the search form about `\humanized\translation\models\Language`.
 */
class TranslationSearch extends Translation
{
    


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'system_name'], 'safe'],
            [['is_default', 'is_enabled'], 'integer'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Translation::find();
        $query->select(['*','system_name'=>'language.system_name']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'is_default' => SORT_DESC,
                    'is_enabled' => SORT_DESC,
                ]
            ],
        ]);
        $this->load($params);
        $query->joinWith('language');
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'is_default' => $this->is_default,
            'is_enabled' => $this->is_enabled,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
                ->andFilterWhere(['like', 'system_name', $this->system_name]);

        return $dataProvider;
    }

}
