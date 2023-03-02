<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%convocazioni}}".
 *
 * @property string $oggetto
 * @property string $corpo
 * @property string $destinatari
 *
 * @property TipoVerbali $tipo0
 */
class Email extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%email}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oggetto', 'corpo', 'destinatari'], 'required'],
            [['oggetto', 'corpo', 'destinatari'], 'string'],
            [['oggetto'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'oggetto' => Yii::t('app', 'Oggetto'),
            'corpo' => Yii::t('app', 'Corpo'),
            'destinatari' => Yii::t('app', 'Destinatari'),
        ];
    }

}
