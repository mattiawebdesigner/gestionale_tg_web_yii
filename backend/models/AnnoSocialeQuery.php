<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[AnnoSociale]].
 *
 * @see AnnoSociale
 */
class AnnoSocialeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AnnoSociale[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AnnoSociale|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
