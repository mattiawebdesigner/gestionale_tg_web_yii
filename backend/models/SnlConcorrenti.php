<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lns_concorrenti".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $data_di_nascita
 * @property string $luogo_di_nascita
 * @property string $indirizzo
 * @property string|null $numero_civico
 * @property string $provincia_nascita
 * @property string $provincia_residenza
 * @property string $cellulare
 * @property string $email
 * @property string|null $nome_gruppo
 * @property string $brani
 * @property string $citta_residenza
 * @property int $contest
 * @property string $note
 *
 * @property Allegati[] $allegatis
 * @property Contest $contest0
 * @property Nominativi[] $nominativis
 */
class SnlConcorrenti extends \yii\db\ActiveRecord
{
    
    public $tipo;
    public $componenti;
    public $date_di_nascita;
    public $strumenti;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_concorrenti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cognome', 'data_di_nascita', 'luogo_di_nascita', 'indirizzo', 'provincia_nascita', 'provincia_residenza', 'cellulare', 'email', 'brani', 'contest', 'citta_residenza'], 'required'],
            [['data_di_nascita'], 'safe'],
            [['contest'], 'integer'],
            [['componenti', 'date_di_nascita', 'strumenti'], 'string'],
            [['tipo'], 'string'],
            [['nome', 'cognome', 'luogo_di_nascita', 'email'], 'string', 'max' => 100],
            [['indirizzo', 'nome_gruppo', 'note'], 'string', 'max' => 255],
            [['numero_civico'], 'string', 'max' => 5],
            [['provincia_nascita', 'provincia_residenza'], 'string', 'max' => 3],
            [['cellulare'], 'string', 'max' => 10],
            [['citta_residenza'], 'string', 'max' => 50],
            [['brani'], 'string', 'max' => 500],
            [['contest'], 'exist', 'skipOnError' => true, 'targetClass' => SnlContest::className(), 'targetAttribute' => ['contest' => 'id']],
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
            'data_di_nascita' => Yii::t('app', 'Data Di Nascita'),
            'luogo_di_nascita' => Yii::t('app', 'Luogo Di Nascita'),
            'indirizzo' => Yii::t('app', 'Indirizzo'),
            'numero_civico' => Yii::t('app', 'Numero Civico'),
            'provincia_nascita' => Yii::t('app', 'Provincia Nascita'),
            'provincia_residenza' => Yii::t('app', 'Provincia Residenza'),
            'cellulare' => Yii::t('app', 'Cellulare'),
            'email' => Yii::t('app', 'Email'),
            'nome_gruppo' => Yii::t('app', 'Nome Gruppo'),
            'brani' => Yii::t('app', 'Brani'),
            'citta_residenza' => Yii::t('app', 'Città Residenza'),
            'note' => Yii::t('app', 'Note'),
        ];
    }

    /**
     * Gets query for [[Allegatis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAllegatis()
    {
        return $this->hasMany(Allegati::className(), ['concorrente' => 'id', 'contest' => 'contest']);
    }

    /**
     * Gets query for [[Contest0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContest0()
    {
        return $this->hasOne(Contest::className(), ['id' => 'contest']);
    }

    /**
     * Gets query for [[Nominativis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNominativis()
    {
        return $this->hasMany(Nominativi::className(), ['concorrente' => 'id', 'contest' => 'contest']);
    }
}