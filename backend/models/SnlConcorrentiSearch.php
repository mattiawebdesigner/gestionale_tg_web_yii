<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SnlConcorrenti;

/**
 * ConcorrentiSearch represents the model behind the search form of `frontend\models\Concorrenti`.
 */
class SnlConcorrentiSearch extends SnlConcorrenti
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'contest'], 'integer'],
            [['nome', 'cognome', 'data_di_nascita', 'luogo_di_nascita', 'indirizzo', 'numero_civico', 'provincia_nascita', 'provincia_residenza', 'cellulare', 'email', 'nome_gruppo', 'brani'], 'safe'],
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
        $query = SnlConcorrenti::find();

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
            'contest' => $this->contest,
        ]);
        $query->andFilterWhere([
            'contest' => \backend\models\SnlContest::findOne(
                            SnlEdizione::find()->orderBy(['anno' => SORT_DESC])->one()->contest
                        )->id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'luogo_di_nascita', $this->luogo_di_nascita])
            ->andFilterWhere(['like', 'indirizzo', $this->indirizzo])
            ->andFilterWhere(['like', 'numero_civico', $this->numero_civico])
            ->andFilterWhere(['like', 'provincia_nascita', $this->provincia_nascita])
            ->andFilterWhere(['like', 'provincia_residenza', $this->provincia_residenza])
            ->andFilterWhere(['like', 'cellulare', $this->cellulare])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nome_gruppo', $this->nome_gruppo])
            ->andFilterWhere(['like', 'brani', $this->brani]);

        return $dataProvider;
    }
}
