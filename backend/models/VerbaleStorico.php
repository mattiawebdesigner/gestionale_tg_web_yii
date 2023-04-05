<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "verbali".
 *
 * @property int $id
 * @property string $numero_protocollo
 * @property string $oggetto
 * @property string $ordine_del_giorno
 * @property string $data
 * @property string $ora_inizio
 * @property string $ora_fine
 * @property string $data_inserimento
 * @property string $ultima_modifica
 * @property string $firma
 * @property int $tipo
 * @property string $contenuto
 * @property int $bozza
 *
 * @property TipoVerbali $tipo0
 */
class VerbaleStorico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verbale_storico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero_protocollo', 'oggetto', 'ordine_del_giorno', 'data', 'ora_inizio', 'ora_fine', 'firma', 'tipo', 'contenuto'], 'required'],
            [['data', 'ora_inizio', 'ora_fine', 'data_inserimento', 'ultima_modifica'], 'safe'],
            [['tipo', 'bozza'], 'integer'],
            [['contenuto'], 'string'],
            [['numero_protocollo'], 'string', 'max' => 10],
            [['oggetto', 'ordine_del_giorno'], 'string', 'max' => 255],
            [['firma'], 'string', 'max' => 100],
            [['numero_protocollo'], 'unique'],
            [['tipo'], 'exist', 'skipOnError' => true, 'targetClass' => TipoVerbali::className(), 'targetAttribute' => ['tipo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'numero_protocollo' => Yii::t('app', 'Numero Protocollo'),
            'oggetto' => Yii::t('app', 'Oggetto'),
            'ordine_del_giorno' => Yii::t('app', 'Ordine Del Giorno'),
            'data' => Yii::t('app', 'Data'),
            'ora_inizio' => Yii::t('app', 'Ora Inizio'),
            'ora_fine' => Yii::t('app', 'Ora Fine'),
            'data_inserimento' => Yii::t('app', 'Data Inserimento'),
            'ultima_modifica' => Yii::t('app', 'Ultima Modifica'),
            'firma' => Yii::t('app', 'Firma'),
            'tipo' => Yii::t('app', 'Tipo'),
            'contenuto' => Yii::t('app', 'Contenuto'),
            'bozza' => Yii::t('app', 'Bozza'),
        ];
    }

    /**
     * Gets query for [[Tipo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipo0()
    {
        return $this->hasOne(TipoVerbali::className(), ['id' => 'tipo']);
    }
}
