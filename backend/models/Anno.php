<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "anno".
 *
 * @property string $anno
 *
 * @property Rendiconto[] $rendicontos
 */
class Anno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anno'], 'required'],
            [['anno'], 'safe'],
            [['anno'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'anno' => Yii::t('app', 'Anno'),
        ];
    }

    /**
     * Gets query for [[Rendicontos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRendicontos()
    {
        return $this->hasMany(Rendiconto::className(), ['anno' => 'anno']);
    }
}
