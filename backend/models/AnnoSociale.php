<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%anno_sociale}}".
 *
 * @property string $anno
 * @property float $quotaSocioOrdinario
 * @property float $quotaSocioSostenitore
 *
 * @property SocioAnnoSociale[] $socioAnnoSociales
 * @property Soci[] $socios
 */
class AnnoSociale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%anno_sociale}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anno', 'quotaSocioOrdinario', 'quotaSocioSostenitore'], 'required'],
            [['anno'], 'safe'],
            [['quotaSocioOrdinario', 'quotaSocioSostenitore'], 'number'],
            [['anno'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'anno' => Yii::t('app', 'Anno'),
            'quotaSocioOrdinario' => Yii::t('app', 'Quota Socio Ordinario'),
            'quotaSocioSostenitore' => Yii::t('app', 'Quota Socio Sostenitore'),
        ];
    }

    /**
     * Gets query for [[SocioAnnoSociales]].
     *
     * @return \yii\db\ActiveQuery|SocioAnnoSocialeQuery
     */
    public function getSocioAnnoSociales()
    {
        return $this->hasMany(SocioAnnoSociale::className(), ['anno' => 'anno']);
    }

    /**
     * Gets query for [[Socios]].
     *
     * @return \yii\db\ActiveQuery|SociQuery
     */
    public function getSocios()
    {
        return $this->hasMany(Soci::className(), ['id' => 'socio'])->viaTable('{{%socio_anno_sociale}}', ['anno' => 'anno']);
    }

    /**
     * {@inheritdoc}
     * @return AnnoSocialeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AnnoSocialeQuery(get_called_class());
    }
}
