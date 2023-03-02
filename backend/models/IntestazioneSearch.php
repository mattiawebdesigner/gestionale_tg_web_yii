<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Intestazione;

/**
 * IntestazioneSearch represents the model behind the search form of `backend\models\Intestazione`.
 */
class IntestazioneSearch extends Intestazione
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['logo', 'nome', 'cap', 'citta', 'provincia', 'codice_fiscale', 'piva', 'sito', 'immagine'], 'safe'],
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
        $query = Intestazione::find();

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
        ]);

        $query->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'cap', $this->cap])
            ->andFilterWhere(['like', 'citta', $this->citta])
            ->andFilterWhere(['like', 'provincia', $this->provincia])
            ->andFilterWhere(['like', 'codice_fiscale', $this->codice_fiscale])
            ->andFilterWhere(['like', 'piva', $this->piva])
            ->andFilterWhere(['like', 'sito', $this->sito])
            ->andFilterWhere(['like', 'immagine', $this->immagine]);

        return $dataProvider;
    }
}
