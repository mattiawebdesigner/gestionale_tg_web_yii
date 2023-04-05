<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * GiudiciSearch represents the model behind the search form of `frontend\models\Giudici`.
 */
class SnlGiudiciSearch extends SnlGiudici
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'contest'], 'integer'],
            [['nome', 'cognome', 'descrizione'], 'safe'],
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
    public function searchGiudiciInCorso($params)
    {
        $query = SnlGiudici::find();

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
            'id' => $this->id,
        ]);
        
        $query->andFilterWhere([
            'contest' => \backend\models\SnlContest::findOne(
                            SnlEdizione::find()->orderBy(['anno' => SORT_DESC])->one()->contest
                        )->id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'descrizione', $this->descrizione]);

        return $dataProvider;
    }
}
