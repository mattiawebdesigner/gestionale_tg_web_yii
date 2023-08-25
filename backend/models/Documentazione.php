<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%documentazione}}".
 *
 * @property int $id
 * @property string $link
 * @property string $mime
 * @property string $visibile_socio
 * @property string $fileName
 * @property string $data_inserimento
 * @property string $ultima_modifica
 */
class Documentazione extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%documentazione}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link', 'mime', 'fileName', 'categoria'], 'required'],
            [['visibile_socio'], 'string'],
            [['data_inserimento', 'ultima_modifica'], 'safe'],
            [['categoria'], 'integer'], 
            [['link', 'fileName'], 'string', 'max' => 255],
            [['mime'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'link' => Yii::t('app', 'Link'),
            'mime' => Yii::t('app', 'Mime'),
            'visibile_socio' => Yii::t('app', 'Visibile Socio'),
            'fileName' => Yii::t('app', 'File Name'),
            'data_inserimento' => Yii::t('app', 'Data Inserimento'),
            'ultima_modifica' => Yii::t('app', 'Ultima Modifica'),
            'categoria' => Yii::t('app', 'Categoria della documentazione'), 
        ];
    }

    /**
     * {@inheritdoc}
     * @return DocumentazioneQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocumentazioneQuery(get_called_class());
    }
}
