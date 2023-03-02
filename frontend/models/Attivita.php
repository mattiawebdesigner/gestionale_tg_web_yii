<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "attivita".
 *
 * @property int $id
 * @property string $nome
 * @property string $foto
 * @property string|null $descrizione
 * @property string|null $data_ultima_modifica
 * @property string|null $data_inserimento
 * @property string $luogo
 * @property string|null $data_attivita
 *
 * @property Nominativo[] $nominativos
 * @property Partecipazione[] $partecipaziones
 */
class Attivita extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attivita';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'foto', 'luogo'], 'required'],
            [['descrizione'], 'string'],
            [['data_ultima_modifica', 'data_inserimento', 'data_attivita'], 'safe'],
            [['nome'], 'string', 'max' => 150],
            [['foto'], 'string', 'max' => 255],
            [['luogo'], 'string', 'max' => 100],
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
            'foto' => Yii::t('app', 'Foto'),
            'descrizione' => Yii::t('app', 'Descrizione'),
            'data_ultima_modifica' => Yii::t('app', 'Data Ultima Modifica'),
            'data_inserimento' => Yii::t('app', 'Data Inserimento'),
            'luogo' => Yii::t('app', 'Luogo'),
            'data_attivita' => Yii::t('app', 'Data Attivita'),
        ];
    }

    /**
     * Gets query for [[Nominativos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNominativos()
    {
        return $this->hasMany(Nominativo::className(), ['id' => 'nominativo'])->viaTable('partecipazione', ['attivita' => 'id']);
    }

    /**
     * Gets query for [[Partecipaziones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartecipaziones()
    {
        return $this->hasMany(Partecipazione::className(), ['attivita' => 'id']);
    }
}
