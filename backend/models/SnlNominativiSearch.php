<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SnlNominativi;

/**
 * NominativiSearch represents the model behind the search form of `backend\models\SnlNominativi`.
 */
class SnlNominativiSearch extends SnlNominativi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'concorrente', 'contest'], 'integer'],
            [['nominativo', 'data_di_nascita', 'strumento', 'data_inserimento', 'ultima_modifica'], 'safe'],
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
        $query = SnlNominativi::find();

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
            'data_di_nascita' => $this->data_di_nascita,
            'data_inserimento' => $this->data_inserimento,
            'ultima_modifica' => $this->ultima_modifica,
            'concorrente' => $this->concorrente,
            'contest' => $this->contest,
        ]);

        $query->andFilterWhere(['like', 'nominativo', $this->nominativo])
            ->andFilterWhere(['like', 'strumento', $this->strumento]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchWithConcorrenteId($params, $concorrente_id)
    {
        $query = SnlNominativi::find()->where(['concorrente' => $concorrente_id]);

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
            'data_di_nascita' => $this->data_di_nascita,
            'data_inserimento' => $this->data_inserimento,
            'ultima_modifica' => $this->ultima_modifica,
            'concorrente' => $this->concorrente,
            'contest' => $this->contest,
        ]);

        $query->andFilterWhere(['like', 'nominativo', $this->nominativo])
            ->andFilterWhere(['like', 'strumento', $this->strumento]);

        return $dataProvider;
    }
}
