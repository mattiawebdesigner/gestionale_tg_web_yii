<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Attivita]].
 *
 * @see Attivita
 */
class AttivitaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Attivita[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Attivita|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
