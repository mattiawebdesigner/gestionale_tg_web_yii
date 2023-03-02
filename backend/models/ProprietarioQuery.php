<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Proprietario]].
 *
 * @see Proprietario
 */
class ProprietarioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Proprietario[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Proprietario|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
