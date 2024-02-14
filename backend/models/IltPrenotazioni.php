<?php

namespace app\models;

use Yii;
use backend\components\sistema_prenotazione_biglietti\Postazioni;

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
 * @property int $data_registrazione
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
            [['spettacolo', 'nome', 'cognome', 'email', 'cellulare', 'pagato'], 'required'],
            [['nome', 'cognome', 'email', 'cellulare', 'prenotazione', 'abbonamento'], 'string'],
            [['posto'], 'integer'],
            [['data_registrazione'], 'safe']
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
            'data_registrazione' => Yii::t('app', 'Data della prenotazione'),
            'prenotazione' => Yii::t('app', 'Prenotazione'),
            'abbonamento' => Yii::t('app', 'Abbonamento'),
        ];
    }
    
    public static function totali($prenotazioni, $piantina){
        $nOfSeatBooked = 0;
        foreach ($prenotazioni as $prenotazione){            
            $nOfSeatBooked += Postazioni::nOfSeatBooked($prenotazione->prenotazione, $prenotazione->abbonamento);
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
            
            if(!is_null($prenotazione->abbonamento)){
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
