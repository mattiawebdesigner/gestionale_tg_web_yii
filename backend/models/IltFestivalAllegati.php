<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_festival_allegati}}".
 *
 * @property int $festival
 * @property int $allegato
 *
 * @property IltAllegati $allegato0
 * @property IltFestival $festival0
 */
class IltFestivalAllegati extends \yii\db\ActiveRecord
{
    const TIPO0 = 0;
    const TIPO1 = 1;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_festival_allegati}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['festival', 'allegato'], 'required'],
            [['festival', 'allegato', 'tipo'], 'integer'],
            [['festival', 'allegato'], 'unique', 'targetAttribute' => ['festival', 'allegato']],
            [['allegato'], 'exist', 'skipOnError' => true, 'targetClass' => IltAllegati::className(), 'targetAttribute' => ['allegato' => 'id']],
            [['festival'], 'exist', 'skipOnError' => true, 'targetClass' => IltFestival::className(), 'targetAttribute' => ['festival' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'festival' => Yii::t('app', 'Festival'),
            'allegato' => Yii::t('app', 'Allegato'),
        ];
    }

    /**
     * Gets query for [[Allegato0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAllegato0()
    {
        return $this->hasOne(IltAllegati::className(), ['id' => 'allegato']);
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
}
