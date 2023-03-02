<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "nominativo".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $data_inserimento
 * @property string $data_ultima_modifica
 * @property string|null $data_di_nascita
 * @property string|null $foto
 *
 * @property Attivitum[] $attivitas
 * @property Partecipazione[] $partecipaziones
 */
class Nominativo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nominativo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cognome'], 'required'],
            [['data_inserimento', 'data_ultima_modifica', 'data_di_nascita'], 'safe'],
            [['nome', 'cognome'], 'string', 'max' => 50],
            [['foto'], 'string', 'max' => 255],
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
            'data_inserimento' => Yii::t('app', 'Data Inserimento'),
            'data_ultima_modifica' => Yii::t('app', 'Data Ultima Modifica'),
            'data_di_nascita' => Yii::t('app', 'Data Di Nascita'),
            'foto' => Yii::t('app', 'Foto'),
        ];
    }

    /**
     * Gets query for [[Attivitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttivitas()
    {
        return $this->hasMany(Attivita::className(), ['id' => 'attivita'])->viaTable('partecipazione', ['nominativo' => 'id']);
    }

    /**
     * Gets query for [[Partecipaziones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartecipaziones()
    {
        return $this->hasMany(Partecipazione::className(), ['nominativo' => 'id']);
    }
}
