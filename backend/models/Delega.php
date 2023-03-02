<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%delega}}".
 *
 * @property int    $id
 * @property string $convocazione_id
 * @property int    $delegante
 * @property int    $delegato
 * @property date   $data_riunione
 * @property date   $data_creazione
 *
 * @property Verbali $verbale
 */
class Delega extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%delega}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['convocazione_id', 'delegato'], 'required'],
            [['id', 'delegante', 'delegato'], 'number'],
            [['data_riunione', 'data_creazione'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'convocazione_id' => Yii::t('app', 'Protocoloo della convocazione'),
            'delegante' => Yii::t('app', 'Delegante'),
            'delgato' => Yii::t('app', 'Delegato'),
            'data_riunione' => Yii::t('app', 'Data della riunione'),
            'data_creazione' => Yii::t('app', 'Data di creazione'),
        ];
    }

    /**
     * Gets query for [[Verbale]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVerbale()
    {
        return $this->hasOne(Verbali::className(), ['numero_protocollo' => 'id_verbale']);
    }
}
