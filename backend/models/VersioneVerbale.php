<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "verbali".
 *
 * @property int $id
 * @property string $numero_protocollo
 * @property string $numero_protocollo_storico
 * @property string $data_modifica
 * @property int $utente
 *
 * @property TipoVerbali $tipo0
 */
class VersioneVerbale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'versione_verbale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero_protocollo', 'numero_protocollo_storico'], 'required'],
            [['data_modifica'], 'safe'],
            [['utente'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'numero_protocollo' => Yii::t('app', 'Numero Protocollo'),
            'numero_protocollo_storico' => Yii::t('app', 'Numero Protocollo archivio versioni'),
            'ordine_del_giorno' => Yii::t('app', 'Ordine Del Giorno'),
            'data_modifica' => Yii::t('app', 'Data della modifica'),
            'utente' => Yii::t('app', 'Utente che ha effettuato la modifica'),
        ];
    }

    /**
     * Gets query for [[Tipo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtente0()
    {
        return $this->hasOne(Utenti::className(), ['id' => 'utente']);
    }
    
    public function getVerbale0()
    {
        return $this->hasOne(Verbali::className(), ['numero_protocollo' => 'numero_protocollo']);
    }
    
    public function getVerbaleStorico0()
    {
        return $this->hasOne(Utenti::className(), ['id' => 'numero_protocolo_storico']);
    }
}
