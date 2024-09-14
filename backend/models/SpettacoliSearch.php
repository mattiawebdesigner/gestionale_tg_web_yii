<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Spettacoli;

/**
 * IltIscrizioniAllegatiSearch represents the model behind the search form of `backend\models\IltIscrizioniAllegati`.
 */
class SpettacoliSearch extends Spettacoli
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
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
        $query = Spettacoli::find();

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
            'data'          => $this->data,
            'ora_porta'     => $this->ora_porta,
            'ora_sipario'   => $this->ora_sipario,
        ]);

        $query->andFilterWhere(['like', 'spettacolo', $this->spettacolo])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}
