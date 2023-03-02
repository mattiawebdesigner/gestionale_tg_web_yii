<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Prenotazioni]].
 *
 * @see Prenotazioni
 */
class PrenotazioniQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Prenotazioni[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Prenotazioni|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
