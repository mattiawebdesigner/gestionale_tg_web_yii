<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%prenotazioni}}".
 *
 * @property int $prenotazioni
 * @property string $email
 * @property int $attivita_id
 */
class Prenotazioni extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%prenotazioni}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prenotazioni', 'email', 'attivita_id'], 'required'],
            [['prenotazioni', 'attivita_id', 'id'], 'integer'],
            [['email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'prenotazioni' => Yii::t('app', 'Prenotazioni'),
            'email' => Yii::t('app', 'Email'),
            'attivita_id' => Yii::t('app', 'Attivita ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return PrenotazioniQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PrenotazioniQuery(get_called_class());
    }
}
