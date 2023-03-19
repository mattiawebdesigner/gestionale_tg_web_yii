<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SnlPartner;

/**
 * PartnerSearch represents the model behind the search form of `backend\models\Partner`.
 */
class SnlPartnerSearch extends SnlPartner
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ordinamento', 'contest'], 'integer'],
            [['partner', 'note', 'tipo_di_sponsorizzazione', 'postazioni', 'logo'], 'safe'],
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
    public function search($params/*, $partner = SnlPartner::PA_ASSOCIAZIONI*/)
    {
        $query = SnlPartner::find();

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
            'id'                    => $this->id,
            'ordinamento'           => $this->ordinamento,
            //'tipologia_di_partner'  => $partner,
        ]);
        $query->andFilterWhere([
            'contest' => \backend\models\SnlContest::findOne(
                            SnlEdizione::find()->orderBy(['anno' => SORT_DESC])->one()->contest
                        )->id,
        ]);

        $query->andFilterWhere(['like', 'partner', $this->partner])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'tipo_di_sponsorizzazione', $this->tipo_di_sponsorizzazione])
            ->andFilterWhere(['like', 'postazioni', $this->postazioni])
            ->andFilterWhere(['like', 'logo', $this->logo]);

        return $dataProvider;
    }
}
