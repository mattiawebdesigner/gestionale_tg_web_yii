<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%media}}".
 *
 * @property int $id
 * @property string $nome
 * @property string $link
 * @property string $mime
 */
class Media extends \yii\db\ActiveRecord
{
    public $image;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%media}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'link', 'mime'], 'required'],
            [['nome', 'link'], 'string', 'max' => 255],
            [['mime'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
            'link' => Yii::t('app', 'Link'),
            'mime' => Yii::t('app', 'Mime'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return MediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MediaQuery(get_called_class());
    }
}
