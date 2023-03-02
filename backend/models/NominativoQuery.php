<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Nominativo]].
 *
 * @see Nominativo
 */
class NominativoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Nominativo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Nominativo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
