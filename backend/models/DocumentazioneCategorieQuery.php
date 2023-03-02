<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[DocumentazioneCategorie]].
 *
 * @see DocumentazioneCategorie
 */
class DocumentazioneCategorieQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return DocumentazioneCategorie[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return DocumentazioneCategorie|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
