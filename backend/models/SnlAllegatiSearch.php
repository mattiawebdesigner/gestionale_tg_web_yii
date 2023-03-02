<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Allegati;

/**
 * AllegatiSearch represents the model behind the search form of `frontend\models\Allegati`.
 */
class SnlAllegatiSearch extends Allegati
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'concorrente', 'contest'], 'integer'],
            [['nome_allegato', 'allegato', 'lns_allegaticol'], 'safe'],
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
        $query = Allegati::find();

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
            'concorrente' => $this->concorrente,
            'contest' => $this->contest,
        ]);

        $query->andFilterWhere(['like', 'nome_allegato', $this->nome_allegato])
            ->andFilterWhere(['like', 'allegato', $this->allegato])
            ->andFilterWhere(['like', 'lns_allegaticol', $this->lns_allegaticol]);

        return $dataProvider;
    }
}
