<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SnlArticoli;

/**
 * ArticoliSearch represents the model behind the search form of `frontend\models\Articoli`.
 */
class SnlArticoliSearch extends SnlArticoli
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'categoria', 'utente'], 'integer'],
            [['titolo', 'contenuto', 'data_pubblicazione', 'inizio_pubblicazione', 'fine_pubblicazione', 'immagine_in_evidenza', 'meta_description', 'meta_keyword'], 'safe'],
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
        $query = SnlArticoli::find();

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
            'data_pubblicazione' => $this->data_pubblicazione,
            'inizio_pubblicazione' => $this->inizio_pubblicazione,
            'fine_pubblicazione' => $this->fine_pubblicazione,
            'categoria' => $this->categoria,
            'utente' => $this->utente,
        ]);

        $query->andFilterWhere(['like', 'titolo', $this->titolo])
            ->andFilterWhere(['like', 'contenuto', $this->contenuto])
            ->andFilterWhere(['like', 'immagine_in_evidenza', $this->immagine_in_evidenza])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'meta_keyword', $this->meta_keyword]);

        return $dataProvider;
    }
}
