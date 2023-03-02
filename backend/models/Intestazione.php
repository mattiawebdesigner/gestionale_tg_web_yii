<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "intestazione".
 *
 * @property int $id
 * @property string $logo
 * @property string $nome
 * @property string $cap
 * @property string $citta
 * @property string $provincia
 * @property string $codice_fiscale
 * @property string $piva
 * @property string $sito
 * @property string $immagine
 *
 * @property IntestazioneSocial[] $intestazioneSocials
 * @property Social[] $socials
 */
class Intestazione extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'intestazione';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['logo', 'nome', 'cap', 'citta', 'provincia', 'codice_fiscale', 'piva', 'sito', 'immagine'], 'required'],
            [['logo', 'immagine'], 'string', 'max' => 255],
            [['nome', 'provincia'], 'string', 'max' => 50],
            [['cap'], 'string', 'max' => 5],
            [['citta'], 'string', 'max' => 60],
            [['codice_fiscale'], 'string', 'max' => 16],
            [['piva'], 'string', 'max' => 11],
            [['sito'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'logo' => Yii::t('app', 'Logo'),
            'nome' => Yii::t('app', 'Nome'),
            'cap' => Yii::t('app', 'Cap'),
            'citta' => Yii::t('app', 'Citta'),
            'provincia' => Yii::t('app', 'Provincia'),
            'codice_fiscale' => Yii::t('app', 'Codice Fiscale'),
            'piva' => Yii::t('app', 'Piva'),
            'sito' => Yii::t('app', 'Sito'),
            'immagine' => Yii::t('app', 'Immagine'),
        ];
    }

    /**
     * Gets query for [[IntestazioneSocials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIntestazioneSocials()
    {
        return $this->hasMany(IntestazioneSocial::className(), ['id_intestazione' => 'id']);
    }

    /**
     * Gets query for [[Socials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSocials()
    {
        return $this->hasMany(Social::className(), ['id' => 'id_social'])->viaTable('intestazione_social', ['id_intestazione' => 'id']);
    }
}
