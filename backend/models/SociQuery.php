<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Soci]].
 *
 * @see Soci
 */
class SociQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Soci[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Soci|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
