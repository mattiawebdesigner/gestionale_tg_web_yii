<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%artisti}}".
 *
 * @property int $id
 * @property string $nome
 * @property int $postazione
 * @property string $tipologia
 * @property string $descrizione
 * @property int $contest
 *
 * @property Contest $contest0
 */
class SnlArtisti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_artisti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'postazione', 'tipologia', 'descrizione', 'contest'], 'required'],
            [['postazione', 'contest'], 'integer'],
            [['descrizione'], 'string'],
            [['nome', 'tipologia'], 'string', 'max' => 45],
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
            'postazione' => Yii::t('app', 'Postazione'),
            'tipologia' => Yii::t('app', 'Tipologia'),
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
        return $this->hasOne(Contest::className(), ['id' => 'contest']);
    }
}
