<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RendicontoVoci;

/**
 * RendicontoVociSearch represents the model behind the search form of `backend\models\RendicontoVoci`.
 */
class RendicontoVociSearch extends RendicontoVoci
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_rendiconto', 'id_voce'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = RendicontoVoci::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_rendiconto' => $this->id_rendiconto,
            'id_voce' => $this->id_voce,
        ]);

        return $dataProvider;
    }
}
