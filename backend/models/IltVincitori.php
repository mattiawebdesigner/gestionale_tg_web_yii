<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_vincitori}}".
 *
 * @property int $iscrizione
 * @property int $premio
 *
 * @property IltIscrizioni $iscrizione0
 * @property IltPremi $premio0
 */
class IltVincitori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_vincitori}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iscrizione', 'premio'], 'required'],
            [['iscrizione', 'premio'], 'integer'],
            [['iscrizione', 'premio'], 'unique', 'targetAttribute' => ['iscrizione', 'premio']],
            [['iscrizione'], 'exist', 'skipOnError' => true, 'targetClass' => IltIscrizioni::className(), 'targetAttribute' => ['iscrizione' => 'id']],
            [['premio'], 'exist', 'skipOnError' => true, 'targetClass' => IltPremi::className(), 'targetAttribute' => ['premio' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iscrizione' => Yii::t('app', 'Iscrizione'),
            'premio' => Yii::t('app', 'Premio'),
        ];
    }

    /**
     * Gets query for [[Iscrizione0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIscrizione0()
    {
        return $this->hasOne(IltIscrizioni::className(), ['id' => 'iscrizione']);
    }

    /**
     * Gets query for [[Premio0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPremio0()
    {
        return $this->hasOne(IltPremi::className(), ['id' => 'premio']);
    }
}
