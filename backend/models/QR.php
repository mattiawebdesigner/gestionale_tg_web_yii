<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%allegati}}".
 *
 * @property int $id
 * @property string $id_verbale
 *
 * @property Verbali $verbale
 */
class QR extends \yii\base\Model
{
    public $testo;
    public $logo;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['testo'], 'required'],
            [['logo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['testo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'testo' => Yii::t('app', 'Testo'),
            'logo' => Yii::t('app', 'Logo'),
        ];
    }
}
