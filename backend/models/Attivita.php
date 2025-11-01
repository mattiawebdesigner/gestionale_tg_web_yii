<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%attivita}}".
 *
 * @property int $id
 * @property string $nome
 * @property string $foto
 * @property string|null $descrizione
 * @property string|null $data_ultima_modifica
 * @property string|null $data_inserimento
 * @property string $luogo
 * @property string|null $data_attivita
 * @property float $costo
 * @property string $pagamento
 * @property string $prenotazione
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
        return '{{%attivita}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'foto', 'luogo', 'pagamento', 'costo', 'prenotazione', 'annullato'], 'required'],
            [['descrizione','pagamento'], 'string'],
            [['data_ultima_modifica', 'data_inserimento', 'data_attivita'], 'safe'],
            [['nome'], 'string', 'max' => 150],
            [['foto','pagamento'], 'string', 'max' => 255],
            [['luogo'], 'string', 'max' => 100],
            [['posti_disponibili'], 'integer'],
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
            'pagamento' => Yii::t('app', 'A pagamento'),
            'costo' => Yii::t('app', 'Quota'),
            'prenotazione' => Yii::t('app', 'Prenotazione disponibile?'),
            'posti_disponibili' => Yii::t('app', 'Posti disponibili'),
            'annullato' => Yii::t('app', 'Annullato'),
            'parametri' => Yii::t('app', 'Parametri'),
        ];
    }

    /**
     * Gets query for [[Nominativos]].
     *
     * @return \yii\db\ActiveQuery|NominativoQuery
     */
    public function getNominativos()
    {
        return $this->hasMany(Nominativo::className(), ['id' => 'nominativo'])->viaTable('{{%partecipazione}}', ['attivita' => 'id']);
    }

    /**
     * Gets query for [[Partecipaziones]].
     *
     * @return \yii\db\ActiveQuery|PartecipazioneQuery
     */
    public function getPartecipaziones()
    {
        return $this->hasMany(Partecipazione::className(), ['attivita' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AttivitaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AttivitaQuery(get_called_class());
    }
}
