<?php

namespace backend\models;

use Yii;
use backend\components\sistema_prenotazione_biglietti\Postazioni;

/**
 * This is the model class for table "{{%prenotazioni}}".
 *
 * @property int $prenotazioni
 * @property string $nome
 * @property string $cognome
 * @property string $email
 * @property string $cellulare
 * @property string $spettacolo
 * @property date $data_registrazione
 * @property string $prenotazione
 * @property date $ultima_modifica
 */
class SpettacoloPrenotazione extends \yii\db\ActiveRecord
{
    const PAGATO = 10;
    const NON_PAGATO = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%spettacolo_prenotazione}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['spettacolo', 'nome', 'cognome', 'email', 'cellulare'], 'required'],
            [['nome', 'cognome', 'email', 'cellulare', 'prenotazione'], 'string'],
            [['data_registrazione', 'ultima_modifica'], 'safe']
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
            'data_registrazione' => Yii::t('app', 'Data della prenotazione'),
            'ultima_modifica' => Yii::t('app', 'Ultima modifica'),
            'prenotazione' => Yii::t('app', 'Prenotazione'),
        ];
    }
    
    public static function totali($prenotazioni, $piantina){
        $nOfSeatBooked = 0;
        foreach ($prenotazioni as $prenotazione){            
            $nOfSeatBooked += Postazioni::nOfSeatBooked($prenotazione->prenotazione, /*$prenotazione->abbonamento*/null);
        }
        //------------------------------
        $nOfSeatState   = [];
        foreach ($prenotazioni as $prenotazione){         
            if(!is_null($prenotazione->prenotazione)){   
                $res = Postazioni::nOfSeatState($piantina, $prenotazione->prenotazione);
                $nOfSeatState[$prenotazione->email]['nOfSeatPaid'] = $res['nOfSeatPaid'];
                $nOfSeatState[$prenotazione->email]['nOfSeatNotPaid'] = $res['nOfSeatNotPaid'];
                $nOfSeatState[$prenotazione->email]['nOfSeatPress'] = $res['nOfSeatPress'];
                $nOfSeatState[$prenotazione->email]['tot'] = $res['tot'];
            }
            
            if(isset($prenotazione->abbonamento) && !is_null($prenotazione->abbonamento)){
                $subscriber = Postazioni::nOfSeatState($piantina, $prenotazione->abbonamento);
                $nOfSeatState[$prenotazione->email]['subcribers']['nOfSeatPaid'] = $subscriber['nOfSeatPaid'];
                $nOfSeatState[$prenotazione->email]['subcribers']['nOfSeatNotPaid'] = $subscriber['nOfSeatNotPaid'];
                $nOfSeatState[$prenotazione->email]['subcribers']['tot'] = $subscriber['tot'];
            }
        }
        
        return [
            'nOfSeatBooked'     => $nOfSeatBooked,
            'nOfSeatState'      => $nOfSeatState,
        ];
    }
    
}
