<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Commenti;

/**
 * CommentiSearch represents the model behind the search form of `frontend\models\Commenti`.
 */
class SnlCommentiSearch extends Commenti
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'approvato'], 'integer'],
            [['commento', 'data'], 'safe'],
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
        $query = Commenti::find();

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
            'data' => $this->data,
            'approvato' => $this->approvato,
        ]);

        $query->andFilterWhere(['like', 'commento', $this->commento]);

        return $dataProvider;
    }
}
