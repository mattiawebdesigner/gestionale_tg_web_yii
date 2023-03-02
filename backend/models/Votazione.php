<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%votazione}}".
 *
 * @property int $id
 * @property string $id_verbale
 *
 * @property Verbali $verbale
 */
class Votazione extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%votazione}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anno', 'data_creazione'], 'number'],
            [['anno', 'info'], 'required'],
            [['info', 'luogo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'anno' => Yii::t('app', 'Anno'),
            'data_creazione' => Yii::t('app', 'Data di creazione'),
            'info' => Yii::t('app', 'Info'),
            'nome_originale' => Yii::t('app', 'Nome originale del file'),
            'luogo' => Yii::t('app', 'Luogo della votazione'),
        ];
    }
}
