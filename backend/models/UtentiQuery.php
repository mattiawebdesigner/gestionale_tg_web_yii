<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Utenti]].
 *
 * @see Utenti
 */
class UtentiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Utenti[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Utenti|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
