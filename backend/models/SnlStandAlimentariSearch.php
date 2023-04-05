<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StandAlimentari;

/**
 * StandAlimentariSearch represents the model behind the search form of `backend\models\StandAlimentari`.
 */
class SnlStandAlimentariSearch extends SnlStandAlimentari
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'n_postazione', 'contest'], 'integer'],
            [['nome', 'tipologia', 'dimensione', 'logo'], 'safe'],
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
    public function searchStandInCorso($params)
    {
        $query = SnlStandAlimentari::find();

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
            'n_postazione' => $this->n_postazione,
        ]);
        $query->andFilterWhere([
            'contest' => \backend\models\SnlContest::findOne(
                            SnlEdizione::find()->orderBy(['anno' => SORT_DESC])->one()->contest
                        )->id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'tipologia', $this->tipologia])
            ->andFilterWhere(['like', 'dimensione', $this->dimensione])
            ->andFilterWhere(['like', 'logo', $this->logo]);

        return $dataProvider;
    }
}
