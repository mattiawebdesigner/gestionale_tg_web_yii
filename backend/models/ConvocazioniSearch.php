<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Convocazioni;

/**
 * ConvocazioniSearch represents the model behind the search form of `backend\models\Convocazioni`.
 */
class ConvocazioniSearch extends Convocazioni
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'integer'],
            [['numero_protocollo'], 'string'],
            [['ordine_del_giorno', 'oggetto', 'data', 'data_inserimento', 'ultima_modifica', 'contenuto'], 'safe'],
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
        $query = Convocazioni::find();

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
            'numero_protocollo' => $this->numero_protocollo,
            'data' => $this->data,
            'data_inserimento' => $this->data_inserimento,
            'ultima_modifica' => $this->ultima_modifica,
            'tipo' => $this->tipo,
        ]);

        $query->andFilterWhere(['like', 'ordine_del_giorno', $this->ordine_del_giorno])
            ->andFilterWhere(['like', 'oggetto', $this->oggetto])
            ->andFilterWhere(['like', 'contenuto', $this->contenuto]);

        return $dataProvider;
    }
}
