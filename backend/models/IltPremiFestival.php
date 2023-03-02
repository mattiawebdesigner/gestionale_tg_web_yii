<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_premi_festival}}".
 *
 * @property int $premio
 * @property int $festival
 *
 * @property IltFestival $festival0
 * @property IltPremi $premio0
 */
class IltPremiFestival extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_premi_festival}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['premio', 'festival'], 'required'],
            [['premio', 'festival'], 'integer'],
            [['premio', 'festival'], 'unique', 'targetAttribute' => ['premio', 'festival']],
            [['festival'], 'exist', 'skipOnError' => true, 'targetClass' => IltFestival::className(), 'targetAttribute' => ['festival' => 'id']],
            [['premio'], 'exist', 'skipOnError' => true, 'targetClass' => IltPremi::className(), 'targetAttribute' => ['premio' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'premio' => Yii::t('app', 'Premio'),
            'festival' => Yii::t('app', 'Festival'),
        ];
    }

    /**
     * Gets query for [[Festival0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFestival0()
    {
        return $this->hasOne(IltFestival::className(), ['id' => 'festival']);
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
