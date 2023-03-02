<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_articoli_commenti}}".
 *
 * @property int $articolo
 * @property int $commento
 *
 * @property IltArticoli $articolo0
 * @property IltCommenti $commento0
 */
class IltArticoliCommenti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_articoli_commenti}}';
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
            [['articolo'], 'exist', 'skipOnError' => true, 'targetClass' => IltArticoli::className(), 'targetAttribute' => ['articolo' => 'id']],
            [['commento'], 'exist', 'skipOnError' => true, 'targetClass' => IltCommenti::className(), 'targetAttribute' => ['commento' => 'id']],
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
        return $this->hasOne(IltArticoli::className(), ['id' => 'articolo']);
    }

    /**
     * Gets query for [[Commento0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommento0()
    {
        return $this->hasOne(IltCommenti::className(), ['id' => 'commento']);
    }
}
