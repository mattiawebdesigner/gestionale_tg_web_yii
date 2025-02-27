<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AnnoSocialeSearch represents the model behind the search form of `backend\models\AnnoSociale`.
 */
class AnnoSocialeSearch extends AnnoSociale
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anno'], 'safe'],
            [['quotaSocioOrdinario', 'quotaSocioSostenitore'], 'number'],
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
        $query = AnnoSociale::find();

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
            'anno' => $this->anno,
            'quotaSocioOrdinario' => $this->quotaSocioOrdinario,
            'quotaSocioSostenitore' => $this->quotaSocioSostenitore,
        ]);

        return $dataProvider;
    }
}
