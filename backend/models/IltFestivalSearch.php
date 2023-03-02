<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\IltFestival;

/**
 * IltFestivalSearch represents the model behind the search form of `backend\models\IltFestival`.
 */
class IltFestivalSearch extends IltFestival
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['anno', 'inizio', 'fine', 'edizione', 'inizio_pubblicazione', 'fine_pubblicazione', 'regolamenti'], 'safe'],
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
        $query = IltFestival::find();

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
            'anno' => $this->anno,
            'inizio' => $this->inizio,
            'fine' => $this->fine,
            'inizio_pubblicazione' => $this->inizio_pubblicazione,
            'fine_pubblicazione' => $this->fine_pubblicazione,
        ]);

        $query->andFilterWhere(['like', 'edizione', $this->edizione])
            ->andFilterWhere(['like', 'regolamenti', $this->regolamenti]);

        return $dataProvider;
    }
}
