<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%giudici}}".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string|null $descrizione
 * @property int $contest
 *
 * @property Contest $contest0
 */
class SnlGiudici extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_giudici';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cognome', 'contest'], 'required'],
            [['descrizione'], 'string'],
            [['contest'], 'integer'],
            [['nome', 'cognome'], 'string', 'max' => 45],
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
            'descrizione' => Yii::t('app', 'Descrizione'),
            'contest' => Yii::t('app', 'Contest'),
        ];
    }

    /**
     * Gets query for [[Contest0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContest0()
    {
        return $this->hasOne(SnlContest::className(), ['id' => 'contest']);
    }
}
