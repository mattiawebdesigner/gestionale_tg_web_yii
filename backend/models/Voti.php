<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%voti}}".
 *
 * @property int $id
 * @property string $id_socio
 * @property string $n_scheda
 *
 * @property Verbali $verbale
 */
class Voti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%voti}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['n_scheda', 'id_socio'], 'required'],
            [['n_scheda'], 'string', 'max' => 10],
            [['id_socio'], 'number'],
            [['id_socio'], 'exist', 'skipOnError' => true, 'targetClass' => Soci::className(), 'targetAttribute' => ['id_socio' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'n_scheda' => Yii::t('app', 'Numero della scheda'),
            'id_socio' => Yii::t('app', 'Socio'),
        ];
    }

    /**
     * Gets query for [[Socio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSocio()
    {
        return $this->hasOne(Verbali::className(), ['id' => 'id_socio']);
    }
}
