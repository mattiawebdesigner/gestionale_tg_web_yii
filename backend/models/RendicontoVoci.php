<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rendiconto_voci".
 *
 * @property int $id_rendiconto
 * @property int $id_voce
 *
 * @property Rendiconto $rendiconto
 * @property Voci $voce
 */
class RendicontoVoci extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rendiconto_voci';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_rendiconto', 'id_voce'], 'required'],
            [['id_rendiconto', 'id_voce'], 'integer'],
            [['id_rendiconto', 'id_voce'], 'unique', 'targetAttribute' => ['id_rendiconto', 'id_voce']],
            [['id_rendiconto'], 'exist', 'skipOnError' => true, 'targetClass' => Rendiconto::className(), 'targetAttribute' => ['id_rendiconto' => 'id']],
            [['id_voce'], 'exist', 'skipOnError' => true, 'targetClass' => Voci::className(), 'targetAttribute' => ['id_voce' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_rendiconto' => Yii::t('app', 'Id Rendiconto'),
            'id_voce' => Yii::t('app', 'Id Voce'),
        ];
    }

    /**
     * Gets query for [[Rendiconto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRendiconto()
    {
        return $this->hasOne(Rendiconto::className(), ['id' => 'id_rendiconto']);
    }

    /**
     * Gets query for [[Voce]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVoce()
    {
        return $this->hasOne(Voci::className(), ['id' => 'id_voce']);
    }
}
