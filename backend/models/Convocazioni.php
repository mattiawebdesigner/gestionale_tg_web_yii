<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%convocazioni}}".
 *
 * @property string $numero_protocollo
 * @property string $ordine_del_giorno
 * @property string $oggetto
 * @property string $data
 * @property string|null $data_inserimento
 * @property string $ultima_modifica
 * @property int $tipo
 * @property string $contenuto
 * @property string $firma 
 * @property string $delega 
 * @property int $bozza
 *
 * @property TipoVerbali $tipo0
 */
class Convocazioni extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%convocazioni}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero_protocollo', 'ordine_del_giorno', 'oggetto', 'data', 'tipo', 'contenuto', 'firma'], 'required'],
            [['data', 'data_inserimento', 'ultima_modifica'], 'safe'],
            [['tipo', 'bozza'], 'integer'],
            [['contenuto', 'delega'], 'string'],
            [['numero_protocollo'], 'string', 'max' => 10],
            [['oggetto', 'firma'], 'string', 'max' => 255],
            [['ordine_del_giorno'], 'string', 'max' => 2000],
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
            'ordine_del_giorno' => Yii::t('app', 'Ordine Del Giorno'),
            'oggetto' => Yii::t('app', 'Oggetto'),
            'data' => Yii::t('app', 'Data'),
            'data_inserimento' => Yii::t('app', 'Data Inserimento'),
            'ultima_modifica' => Yii::t('app', 'Ultima Modifica'),
            'tipo' => Yii::t('app', 'Tipo'),
            'contenuto' => Yii::t('app', 'Contenuto'),
            'firma' => Yii::t('app', 'Firma'), 
            'delega' => Yii::t('app', 'Delega'), 
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
