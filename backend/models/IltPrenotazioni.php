<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ilt_foto".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $email
 * @property string $cellulare
 * @property int $spettacolo
 * @property int $posto
 * @property int $pagato
 */
class IltPrenotazioni extends \yii\db\ActiveRecord
{
    const PAGATO = 10;
    const NON_PAGATO = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ilt_prenotazione';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['spettacolo', 'nome', 'cognome', 'email', 'cellulare', 'posto', 'pagato'], 'required'],
            [['nome', 'cognome', 'email', 'cellulare',], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'spettacolo' => Yii::t('app', 'Spettacolo'),
            'nome' => Yii::t('app', 'Nome'),
            'cognome' => Yii::t('app', 'Cognome'),
            'email' => Yii::t('app', 'Email'),
            'cellulare' => Yii::t('app', 'Cellulare'),
            'posto' => Yii::t('app', 'Posto'),
            'pagato' => Yii::t('app', 'Il ticket è stato pagato?'),
        ];
    }
}
