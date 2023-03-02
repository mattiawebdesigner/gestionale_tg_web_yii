<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_iscrizioni_allegati}}".
 *
 * @property int $iscrizione
 * @property int $allegato
 *
 * @property IltAllegati $allegato0
 * @property IltIscrizioni $iscrizione0
 */
class IltIscrizioniAllegati extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_iscrizioni_allegati}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iscrizione', 'allegato'], 'required'],
            [['iscrizione', 'allegato'], 'integer'],
            [['iscrizione', 'allegato'], 'unique', 'targetAttribute' => ['iscrizione', 'allegato']],
            [['allegato'], 'exist', 'skipOnError' => true, 'targetClass' => IltAllegati::className(), 'targetAttribute' => ['allegato' => 'id']],
            [['iscrizione'], 'exist', 'skipOnError' => true, 'targetClass' => IltIscrizioni::className(), 'targetAttribute' => ['iscrizione' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iscrizione' => Yii::t('app', 'Iscrizione'),
            'allegato' => Yii::t('app', 'Allegato'),
        ];
    }

    /**
     * Gets query for [[Allegato0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAllegato0()
    {
        return $this->hasOne(IltAllegati::className(), ['id' => 'allegato']);
    }

    /**
     * Gets query for [[Iscrizione0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIscrizione0()
    {
        return $this->hasOne(IltIscrizioni::className(), ['id' => 'iscrizione']);
    }
}
