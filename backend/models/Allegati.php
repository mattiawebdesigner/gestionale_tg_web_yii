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
class Allegati extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%allegati}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_verbale'], 'required'],
            [['id_verbale'], 'string', 'max' => 10],
            [['nome_originale', 'nome'], 'string', 'max' => 255],
            [['allegato'], 'file', 'maxFiles' => 10, 'extensions' => 'png, jpg, jpeg, pdf'],
            [['id_verbale'], 'exist', 'skipOnError' => true, 'targetClass' => Verbali::className(), 'targetAttribute' => ['id_verbale' => 'numero_protocollo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_verbale' => Yii::t('app', 'Id Verbale'),
            'allegato' => Yii::t('app', 'Allegato'),
            'nome' => Yii::t('app', 'Nome del file'),
            'nome_originale' => Yii::t('app', 'Nome originale del file'),
        ];
    }

    /**
     * Gets query for [[Verbale]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVerbale()
    {
        return $this->hasOne(Verbali::className(), ['numero_protocollo' => 'id_verbale']);
    }
}
