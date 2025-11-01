<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%prenotazioni}}".
 *
 * @property int $prenotazioni
 * @property string $email
 * @property int $turno
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
            [['prenotazioni', 'attivita_id', 'id', 'turno'], 'integer'],
            [['email'], 'string', 'max' => 255],
            [['nome', 'cognome'], 'string', 'max' => 50],
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
            'turno' => Yii::t('app', 'Turno'),
            'nome' => Yii::t('app', 'Nome'),
            'cognome' => Yii::t('app', 'Cognome'),
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
