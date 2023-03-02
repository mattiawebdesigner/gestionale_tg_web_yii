<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Immagini]].
 *
 * @see Immagini
 */
class ImmaginiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Immagini[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Immagini|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
