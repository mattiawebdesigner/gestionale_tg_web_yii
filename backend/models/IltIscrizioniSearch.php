<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\IltIscrizioni;

/**
 * IltIscrizioniSearch represents the model behind the search form of `backend\models\IltIscrizioni`.
 */
class IltIscrizioniSearch extends IltIscrizioni
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'festival'], 'integer'],
            [['compagnia', 'codice_fiscale_compagnia', 'partita_iva', 'nome_referente', 'cognome_referente', 'codice_fiscale_referente'], 'safe'],
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
        $query = IltIscrizioni::find();

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
            'festival' => $this->festival,
        ]);

        $query->andFilterWhere(['like', 'compagnia', $this->compagnia])
            ->andFilterWhere(['like', 'codice_fiscale_compagnia', $this->codice_fiscale_compagnia])
            ->andFilterWhere(['like', 'partita_iva', $this->partita_iva])
            ->andFilterWhere(['like', 'nome_referente', $this->nome_referente])
            ->andFilterWhere(['like', 'cognome_referente', $this->cognome_referente])
            ->andFilterWhere(['like', 'codice_fiscale_referente', $this->codice_fiscale_referente]);

        return $dataProvider;
    }
    

    /**
     * Creates data provider instance with search query applied.
     * Search troupe for active festival.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchActive($params)
    {
        $query = IltIscrizioni::find();
        
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
            'festival' => IltFestival::findOne(['anno' => date('Y')])->id,
        ]);

        $query->andFilterWhere(['like', 'compagnia', $this->compagnia])
            ->andFilterWhere(['like', 'codice_fiscale_compagnia', $this->codice_fiscale_compagnia])
            ->andFilterWhere(['like', 'partita_iva', $this->partita_iva])
            ->andFilterWhere(['like', 'nome_referente', $this->nome_referente])
            ->andFilterWhere(['like', 'cognome_referente', $this->cognome_referente])
            ->andFilterWhere(['like', 'codice_fiscale_referente', $this->codice_fiscale_referente]);

        return $dataProvider;
    }
}
