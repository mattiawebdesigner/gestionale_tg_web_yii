<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%soci}}".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string|null $email
 * @property string $data_registrazione
 * @property string $data_di_nascita
 * @property string|null $indirizzo	
 *
 * @property AnnoSociale[] $annos
 * @property SocioAnnoSociale[] $socioAnnoSociales
 */
class Soci extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%soci}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cognome', 'data_di_nascita'], 'required'],
            [['data_registrazione', 'data_di_nascita'], 'safe'],
            [['nome', 'cognome'], 'string', 'max' => 40],
            [['email'], 'string', 'max' => 100],
            [['indirizzo'], 'string', 'max' => 255],
            [['email'], 'unique'],
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
