<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Documentazione]].
 *
 * @see Documentazione
 */
class DocumentazioneQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Documentazione[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Documentazione|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
