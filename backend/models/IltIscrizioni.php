<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_iscrizioni}}".
 *
 * @property int $id
 * @property string $compagnia
 * @property string|null $codice_fiscale_compagnia
 * @property string|null $partita_iva
 * @property string $nome_referente
 * @property string $cognome_referente
 * @property string $codice_fiscale_referente
 * @property int $festival
 * @property int $email
 * @property string $pec
 * @property string $federazione
 * @property string $numeroIscrizione
 * @property string $titolo_spettacolo
 * @property string $autore_spettacolo
 *
 * @property IltAllegati[] $allegatos
 * @property IltFestival $festival0
 * @property IltIscrizioniAllegati[] $iltIscrizioniAllegatis
 * @property IltVincitori[] $iltVincitoris
 * @property IltPremi[] $premios
 */
class IltIscrizioni extends \yii\db\ActiveRecord
{
    const TO_BE_APPROVED = 1;
    /**
     * Reject
     */
    const DELETED        = 9;
    /**
     * Accepted
     */
    const SUBSCRIBED     = 10;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_iscrizioni}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['compagnia', 'nome_referente', 'cognome_referente', 'codice_fiscale_referente', 'festival'], 'required'],
            [['festival', 'attivo'], 'integer'],
            [['compagnia'], 'string', 'max' => 150],
            [['titolo_spettacolo'], 'string', 'max' => 100],
            [['autore_spettacolo'], 'string', 'max' => 50],
            [['codice_fiscale_compagnia'], 'string', 'max' => 16],
            [['partita_iva'], 'string', 'max' => 11],
            [['nome_referente', 'cognome_referente'], 'string', 'max' => 50],
            [['codice_fiscale_referente'], 'string', 'max' => 16],
            [['festival'], 'exist', 'skipOnError' => true, 'targetClass' => IltFestival::className(), 'targetAttribute' => ['festival' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'compagnia' => Yii::t('app', 'Compagnia'),
            'codice_fiscale_compagnia' => Yii::t('app', 'C.F. Compagnia'),
            'partita_iva' => Yii::t('app', 'P.Iva'),
            'nome_referente' => Yii::t('app', 'Nome Referente'),
            'cognome_referente' => Yii::t('app', 'Cognome Referente'),
            'codice_fiscale_referente' => Yii::t('app', 'C.F. Referente'),
            'festival' => Yii::t('app', 'Festival'),
            'attivo' => Yii::t('app', 'Stato iscrizione'),
            'email' => Yii::t('app', 'Email'),
            'pec' => Yii::t('app', 'PEC'),
            'federazione' => Yii::t('app', 'Federazione'),
            'numeroIscrizione' => Yii::t('app', 'Numero di iscrizione alla federazione'),
            'titolo_spettacolo' => Yii::t('app', 'Titolo dello spettacolo'),
        ];
    }

    /**
     * Gets query for [[Allegatos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAllegatos()
    {
        return $this->hasMany(IltAllegati::className(), ['id' => 'allegato'])->viaTable('{{%ilt_iscrizioni_allegati}}', ['iscrizione' => 'id']);
    }

    /**
     * Gets query for [[Festival0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFestival0()
    {
        return $this->hasOne(IltFestival::className(), ['id' => 'festival']);
    }

    /**
     * Gets query for [[IltIscrizioniAllegatis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltIscrizioniAllegatis()
    {
        return $this->hasMany(IltIscrizioniAllegati::className(), ['iscrizione' => 'id']);
    }

    /**
     * Gets query for [[IltVincitoris]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltVincitoris()
    {
        return $this->hasMany(IltVincitori::className(), ['iscrizione' => 'id']);
    }

    /**
     * Gets query for [[Premios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPremios()
    {
        return $this->hasMany(IltPremi::className(), ['id' => 'premio'])->viaTable('{{%ilt_vincitori}}', ['iscrizione' => 'id']);
    }
}
