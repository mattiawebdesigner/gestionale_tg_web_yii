<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Voci;

/**
 * VociSearch represents the model behind the search form of `backend\models\Voci`.
 */
class VociSearch extends Voci
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['voce', 'data_contabile', 'data_inserimento', 'ultima_modifica', 'tipologia'], 'safe'],
            [['prezzo'], 'number'],
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
        $query = Voci::find();

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
            'prezzo' => $this->prezzo,
            'data_contabile' => $this->data_contabile,
            'data_inserimento' => $this->data_inserimento,
            'ultima_modifica' => $this->ultima_modifica,
        ]);

        $query->andFilterWhere(['like', 'voce', $this->voce])
            ->andFilterWhere(['like', 'tipologia', $this->tipologia]);

        return $dataProvider;
    }
}
