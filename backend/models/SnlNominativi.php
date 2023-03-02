<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lns_nominativi".
 *
 * @property int $id
 * @property string $nominativo
 * @property string $data_di_nascita
 * @property string $strumento
 * @property string $data_inserimento
 * @property string $ultima_modifica
 * @property int $concorrente
 * @property int $contest
 *
 * @property Concorrenti $concorrente0
 */
class SnlNominativi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_nominativi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nominativo', 'data_di_nascita', 'strumento', 'concorrente', 'contest'], 'required'],
            [['data_di_nascita', 'data_inserimento', 'ultima_modifica'], 'safe'],
            [['concorrente', 'contest'], 'integer'],
            [['nominativo', 'strumento'], 'string', 'max' => 100],
            [['concorrente', 'contest'], 'exist', 'skipOnError' => true, 'targetClass' => SnlConcorrenti::className(), 'targetAttribute' => ['concorrente' => 'id', 'contest' => 'contest']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nominativo' => Yii::t('app', 'Nominativo'),
            'data_di_nascita' => Yii::t('app', 'Data Di Nascita'),
            'strumento' => Yii::t('app', 'Strumento'),
            'data_inserimento' => Yii::t('app', 'Data Inserimento'),
            'ultima_modifica' => Yii::t('app', 'Ultima Modifica'),
            'concorrente' => Yii::t('app', 'Concorrente'),
            'contest' => Yii::t('app', 'Contest'),
        ];
    }

    /**
     * Gets query for [[Concorrente0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConcorrente0()
    {
        return $this->hasOne(Concorrenti::className(), ['id' => 'concorrente', 'contest' => 'contest']);
    }
}
