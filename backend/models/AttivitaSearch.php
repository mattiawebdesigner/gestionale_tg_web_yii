<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AttivitaSearch represents the model behind the search form of `backend\models\Attivita`.
 */
class AttivitaSearch extends Attivita
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nome', 'foto', 'descrizione', 'data_ultima_modifica', 'data_inserimento', 'luogo', 'data_attivita'], 'safe'],
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
     * @param mixed false Se non si vuole l'impaginazione
     *              array Con i dati di configurazione dell'impaginazione
     *
     * @return ActiveDataProvider
     */
    public function search($params, $pagination = ['pageSize' => 10])
    {
        $query = Attivita::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query'         => $query,
            'pagination'    => $pagination,
            'sort'=> ['defaultOrder' => ['nome' => SORT_ASC]],
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
            'data_ultima_modifica' => $this->data_ultima_modifica,
            'data_inserimento' => $this->data_inserimento,
            'data_attivita' => $this->data_attivita,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'descrizione', $this->descrizione])
            ->andFilterWhere(['like', 'luogo', $this->luogo]);

        return $dataProvider;
    }
}
