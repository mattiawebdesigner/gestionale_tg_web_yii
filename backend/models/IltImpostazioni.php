<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_premi}}".
 *
 * @property int $id
 * @property string $impostazione
 * @property string $valore
 * @property string $struttura
 */
class IltImpostazioni extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_impostazioni}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['impostazione'], 'required'],
            [['valore'], 'string', 'max' => 65000],
            [['impostazione'], 'string', 'max' => 50],
            [['struttura'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'impostazione' => Yii::t('app', 'Impostazione'),
            'valore' => Yii::t('app', 'Valore'),
            'struttura' => Yii::t('app', 'Struttura'),
        ];
    }
}
