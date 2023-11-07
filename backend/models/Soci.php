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
 * @property string $luogo_di_nascita
 * @property string $provincia_di_nascita
 * @property string $CAP
 * @property string $citta_di_residenza
 * @property string $provincia_di_residenza
 * @property string $cellulare
 * @property string $codice_fiscale
 * @property string $data_dimissioni
 *                  Se il valore non è settato (NULL) il socio non ha presentato
 *                  le dimissioni.
 *                  Se il valore è una data sono state presentate le dimissioni.
 * @property string $file_dimissioni
 *                  File delle dimissioni del socio.
 *
 * @property AnnoSociale[] $annos
 * @property SocioAnnoSociale[] $socioAnnoSociales
 */
class Soci extends \yii\db\ActiveRecord
{
    
    public const UPLOAD_DIR = "soci_uploads/";
    public const DIR_DIMISSIONI = "dimissioni/";
    
    /**
     * File da caricare
     */
    public $file;
    
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
            [['nome', 'cognome', 'data_di_nascita', 'luogo_di_nascita', 'provincia_di_nascita', 
                'CAP', 'citta_di_residenza', 'provincia_di_residenza', 'cellulare', 'cellulare'], 'required'],
            [['data_registrazione', 'data_di_nascita', 'data_dimissioni'], 'safe'],
            [['nome', 'cognome'], 'string', 'max' => 40],
            [['email'], 'string', 'max' => 100],
            [['indirizzo', 'luogo_di_nascita', 'citta_di_residenza', 'file_dimissioni'], 'string', 'max' => 255],
            [['provincia_di_nascita', 'provincia_di_residenza'], 'string', 'max' => 3],
            [['CAP'], 'string', 'max' => 5],
            [['cellulare'], 'string', 'max' => 10],
            [['codice_fiscale'], 'string', 'max' => 16],
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
            'luogo_di_nascita' => Yii::t('app', 'Luogo di nascita'),
            'provincia_di_nascita' => Yii::t('app', 'Provincia di nascita'),
            'CAP' => Yii::t('app', 'C.A.P. di residenza'),
            'citta_di_residenza' => Yii::t('app', 'Città di residenza'),
            'provincia_di_residenza' => Yii::t('app', 'Provincia di residenza'),
            'cellulare' => Yii::t('app', 'Cellulare'),
            'codice_fiscale' => Yii::t('app', 'Codice fiscale'),
            'data_dimissioni' => Yii::t('app', 'Data delle dimissioni'),
            'file_dimissioni' => Yii::t('app', 'Carica il file delle dimissioni'),
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
    
    public function getFirma()
    {
        return $this->hasMany(Firma::className(), ['socio' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SociQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SociQuery(get_called_class());
    }
    
    /**
     * Recupera i soci attivi
     * 
     * @param array $orderBy Criterio di ordinamento della query
     * @return mixed
     */
    public static function sociAttivi(array $orderBy = ['cognome' => SORT_ASC, 'nome' => SORT_ASC]){
        return  Soci::find()->joinWith('annos')
                        ->where(['anno_sociale.anno' => date('Y')])
                        ->andWhere(['sostenitore' => 'no'])
                        ->andWhere(['validita' => 'si'])
                        ->orderBy($orderBy)
                        ->all();
    }
    
    /**
     * Upload dei file
     * 
     * @return boolean
     */
    public function upload($directory)
    {
        if ($this->validate()) {
            $filename = uniqid(rand(), true);//Rename namefile
            
            $this->file->saveAs(SELF::UPLOAD_DIR . $directory . $filename . '.' . $this->file->extension);
            
            return [
                'fileName'          => Yii::$app->params['site_protocol'].Yii::$app->params['backendWeb'].self::UPLOAD_DIR.$directory.$filename.".".$this->file->extension,
                'type'              => $this->file->type,
                'extension'         => $this->file->extension,
                'uploadDirectory'   => self::UPLOAD_DIR.$directory,
            ];
        } else {
            return false;
        }
    }
}
