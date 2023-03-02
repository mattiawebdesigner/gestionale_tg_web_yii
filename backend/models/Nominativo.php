<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%nominativo}}".
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
        return '{{%nominativo}}';
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
     * @return \yii\db\ActiveQuery|AttivitaQuery
     */
    public function getAttivitas()
    {
        return $this->hasMany(Attivita::className(), ['id' => 'attivita'])->viaTable('{{%partecipazione}}', ['nominativo' => 'id']);
    }

    /**
     * Gets query for [[Partecipaziones]].
     *
     * @return \yii\db\ActiveQuery|PartecipazioneQuery
     */
    public function getPartecipaziones()
    {
        return $this->hasMany(Partecipazione::className(), ['nominativo' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return NominativoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NominativoQuery(get_called_class());
    }
    
    /**
     * Find all user's activity
     * 
     * @param int $id User's ID
     * @return \backend\models\Attivita[]|array
     */
    public static function findAttivita(int $id){
        return Attivita::find()->innerJoin('partecipazione', 'partecipazione.attivita = attivita.id')
                               ->innerJoin('nominativo', 'nominativo.id = partecipazione.nominativo')
                               ->where([
                                   'nominativo.id' => $id,
                               ]);
    }
}
