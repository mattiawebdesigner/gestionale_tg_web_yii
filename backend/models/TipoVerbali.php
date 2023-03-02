<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tipo_verbali".
 *
 * @property int $id
 * @property string $tipologia
 *
 * @property Convocazioni[] $convocazionis
 * @property Verbali[] $verbalis
 */
class TipoVerbali extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_verbali';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipologia'], 'required'],
            [['tipologia'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipologia' => Yii::t('app', 'Tipologia'),
        ];
    }

    /**
     * Gets query for [[Convocazionis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConvocazionis()
    {
        return $this->hasMany(Convocazioni::className(), ['tipo' => 'id']);
    }

    /**
     * Gets query for [[Verbalis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVerbalis()
    {
        return $this->hasMany(Verbali::className(), ['tipo' => 'id']);
    }
}
