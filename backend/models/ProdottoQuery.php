<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Prodotto]].
 *
 * @see Prodotto
 */
class ProdottoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Prodotto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Prodotto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
