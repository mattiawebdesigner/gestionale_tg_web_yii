<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SociSearch represents the model behind the search form of `backend\models\Soci`.
 */
class SociSearch extends Soci
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nome', 'cognome', 'email', 'data_registrazione', 'data_di_nascita', 'indirizzo'], 'safe'],
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
        $query = Soci::find();

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
            'data_registrazione' => $this->data_registrazione,
            'data_di_nascita' => $this->data_di_nascita,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'indirizzo', $this->indirizzo]);

        return $dataProvider;
    }
    

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchSoci($params)
    {
        $query = Soci::find()->joinWith("socioAnnoSociales")->where(['anno' => date('Y')]);

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
            'data_registrazione' => $this->data_registrazione,
            'data_di_nascita' => $this->data_di_nascita,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'indirizzo', $this->indirizzo]);

        return $dataProvider;
    }
    

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchWithRelationship($params)
    {
        $query = Soci::find()->joinWith('annos')
                        ->where(['anno_sociale.anno' => date('Y')])
                        ->andWhere(['sostenitore' => 'no'])
                        ->andWhere(['validita' => 'si']);

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
            'data_registrazione' => $this->data_registrazione,
            'data_di_nascita' => $this->data_di_nascita,
        ]);
        
        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'indirizzo', $this->indirizzo]);

        return $dataProvider;
    }
    
    

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchWithRelationshipSupporter($params)
    {
        $query = Soci::find()->joinWith('annos')
                        ->where(['anno_sociale.anno' => date('Y')])
                        ->andWhere(['sostenitore' => 'si'])
                        ->andWhere(['validita' => 'si']);

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
            'data_registrazione' => $this->data_registrazione,
            'data_di_nascita' => $this->data_di_nascita,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'indirizzo', $this->indirizzo]);

        return $dataProvider;
    }
}
