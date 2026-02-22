<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%socio_has_candidato}}".
 *
 * @property int $socio_id
 * @property string $time_candidatura
 * @property int $votazione_id
 */
class SocioHasCandidato extends \yii\db\ActiveRecord
{    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%socio_has_candidato}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['socio_id', 'votazione_id'], 'required'],
            [['socio_id', 'votazione_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'socio_id' => Yii::t('app', 'ID del socio'),
            'time_candidatura' => Yii::t('app', 'Data e orario di candidatura'),
            'votazione_id' => Yii::t('app', 'Data ID della votazione'),
        ];
    }

    /**
     * Gets query for [[socio]].
     *
     * @return \yii\db\ActiveQuery|SociQuery
     */
    public function getSocio()
    {
        return $this->hasMany(Soci::className(), ['socio_id' => 'id']);
    }

    /**
     * Gets query for [[Votazione]].
     *
     * @return \yii\db\ActiveQuery|SocioAnnoSocialeQuery
     */
    public function getVotazione()
    {
        return $this->hasMany(Votazione::className(), ['socio' => 'id']);
    }
    
    public function getFirma()
    {
        return $this->hasMany(Firma::className(), ['votazione_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SociQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SocioHasCandidatoQuery(get_called_class());
    }
}
