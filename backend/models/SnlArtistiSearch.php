<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SnlArtisti;

/**
 * ArtistiSearch represents the model behind the search form of `frontend\models\Artisti`.
 */
class SnlArtistiSearch extends SnlArtisti
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'postazione', 'contest'], 'integer'],
            [['nome', 'tipologia', 'descrizione'], 'safe'],
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
    public function searchArtistiInCorso($params)
    {
        $query = SnlArtisti::find();

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
            'postazione' => $this->postazione,
            'contest' => $this->contest,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'tipologia', $this->tipologia])
            ->andFilterWhere(['like', 'descrizione', $this->descrizione]);

        return $dataProvider;
    }
}
