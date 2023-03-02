<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "partecipazione".
 *
 * @property int $attivita
 * @property int $nominativo
 * @property int|null $data_partecipazione
 *
 * @property Attivitum $attivita0
 * @property Nominativo $nominativo0
 */
class Partecipazione extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partecipazione';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attivita', 'nominativo'], 'required'],
            [['attivita', 'nominativo', 'data_partecipazione'], 'integer'],
            [['attivita', 'nominativo'], 'unique', 'targetAttribute' => ['attivita', 'nominativo']],
            [['attivita'], 'exist', 'skipOnError' => true, 'targetClass' => Attivita::className(), 'targetAttribute' => ['attivita' => 'id']],
            [['nominativo'], 'exist', 'skipOnError' => true, 'targetClass' => Nominativo::className(), 'targetAttribute' => ['nominativo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'attivita' => Yii::t('app', 'Attivita'),
            'nominativo' => Yii::t('app', 'Nominativo'),
            'data_partecipazione' => Yii::t('app', 'Data Partecipazione'),
        ];
    }

    /**
     * Gets query for [[Attivita0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttivita0()
    {
        return $this->hasOne(Attivita::className(), ['id' => 'attivita']);
    }

    /**
     * Gets query for [[Nominativo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNominativo0()
    {
        return $this->hasOne(Nominativo::className(), ['id' => 'nominativo']);
    }
}
