<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lns_articoli_commenti".
 *
 * @property int $articolo
 * @property int $commento
 *
 * @property Articoli $articolo0
 * @property Commenti $commento0
 */
class SnlArticoliCommenti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_articoli_commenti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['articolo', 'commento'], 'required'],
            [['articolo', 'commento'], 'integer'],
            [['articolo', 'commento'], 'unique', 'targetAttribute' => ['articolo', 'commento']],
            [['articolo'], 'exist', 'skipOnError' => true, 'targetClass' => Articoli::className(), 'targetAttribute' => ['articolo' => 'id']],
            [['commento'], 'exist', 'skipOnError' => true, 'targetClass' => Commenti::className(), 'targetAttribute' => ['commento' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'articolo' => Yii::t('app', 'Articolo'),
            'commento' => Yii::t('app', 'Commento'),
        ];
    }

    /**
     * Gets query for [[Articolo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticolo0()
    {
        return $this->hasOne(Articoli::className(), ['id' => 'articolo']);
    }

    /**
     * Gets query for [[Commento0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommento0()
    {
        return $this->hasOne(SnlCommenti::className(), ['id' => 'commento']);
    }
}
