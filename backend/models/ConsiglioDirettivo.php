<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%soci}}".
 *
 * @property int $id
 * @property string $ruolo
 * @property int $socio
 * @property string $verbale_di_nomina 
 * @property string $data_di_nomina
 *
 * @property Soci[] $soci
 * @property Verbali[] $verbali
 */
class ConsiglioDirettivo extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%consiglio_direttivo}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ruolo', 'verbale_di_nomina ', 'data_di_nomina'], 'required'],
            [['data_di_nomina'], 'safe'],
            [['ruolo'], 'string', 'max' => 50],
            [['socio'], 'integer'],
            [['verbale_di_nomina '], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
            'cognome' => Yii::t('app', 'Cognome'),
            'email' => Yii::t('app', 'Email'),
            'data_registrazione' => Yii::t('app', 'Data Registrazione'),
            'data_di_nascita' => Yii::t('app', 'Data Di Nascita'),
            'indirizzo' => Yii::t('app', 'Indirizzo'),
        ];
    }

    /**
     * Gets query for [[Annos]].
     *
     * @return \yii\db\ActiveQuery|AnnoSocialeQuery
     */
    public function getAnnos()
    {
        return $this->hasMany(AnnoSociale::className(), ['anno' => 'anno'])->viaTable('{{%socio_anno_sociale}}', ['socio' => 'id']);
    }

    /**
     * Gets query for [[SocioAnnoSociales]].
     *
     * @return \yii\db\ActiveQuery|SocioAnnoSocialeQuery
     */
    public function getSocioAnnoSociales()
    {
        return $this->hasMany(SocioAnnoSociale::className(), ['socio' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SociQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SociQuery(get_called_class());
    }
}
