<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%socio_anno_sociale}}".
 *
 * @property int $socio
 * @property string $anno
 * @property string $data_registrazione
 *
 * @property AnnoSociale $anno0
 * @property Soci $socio0
 */
class SocioAnnoSociale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%socio_anno_sociale}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['socio', 'anno', "validita", "sostenitore"], 'required'],
            [['socio'], 'integer'],
            [['anno', 'data_registrazione'], 'safe'],
            [['socio', 'anno'], 'unique', 'targetAttribute' => ['socio', 'anno']],
            [['anno'], 'exist', 'skipOnError' => true, 'targetClass' => AnnoSociale::className(), 'targetAttribute' => ['anno' => 'anno']],
            [['socio'], 'exist', 'skipOnError' => true, 'targetClass' => Soci::className(), 'targetAttribute' => ['socio' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'socio' => Yii::t('app', 'Socio'),
            'anno' => Yii::t('app', 'Anno'),
            'validita' => Yii::t('app', 'Stato di validità del socio'),
            'sostenitore' => Yii::t('app', 'Sostenitore'),
            'data_registrazione' => Yii::t('app', 'Data Registrazione'),
        ];
    }

    /**
     * Gets query for [[Anno0]].
     *
     * @return \yii\db\ActiveQuery|AnnoSocialeQuery
     */
    public function getAnno0()
    {
        return $this->hasOne(AnnoSociale::className(), ['anno' => 'anno']);
    }

    /**
     * Gets query for [[Socio0]].
     *
     * @return \yii\db\ActiveQuery|SociQuery
     */
    public function getSocio0()
    {
        return $this->hasOne(Soci::className(), ['id' => 'socio']);
    }

    /**
     * {@inheritdoc}
     * @return SocioAnnoSocialeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SocioAnnoSocialeQuery(get_called_class());
    }
}
