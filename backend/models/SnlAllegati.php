<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lns_allegati".
 *
 * @property int $id
 * @property string $nome_allegato
 * @property string $allegato
 * @property int $concorrente
 * @property int $contest
 * @property string|null $lns_allegaticol
 *
 * @property Concorrenti $concorrente0
 */
class SnlAllegati extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_allegati';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_allegato', 'allegato', 'concorrente', 'contest'], 'required'],
            [['concorrente', 'contest'], 'integer'],
            [['nome_allegato'], 'string', 'max' => 100],
            [['allegato'], 'string', 'max' => 255],
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
            'nome_allegato' => Yii::t('app', 'Nome Allegato'),
            'allegato' => Yii::t('app', 'Allegato'),
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
