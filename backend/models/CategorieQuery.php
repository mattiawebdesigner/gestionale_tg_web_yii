<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Categorie]].
 *
 * @see Categorie
 */
class CategorieQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Categorie[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Categorie|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
