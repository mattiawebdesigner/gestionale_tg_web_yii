<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%gallery_foto}}".
 *
 * @property int $foto_id
 * @property int $gallery_id
 *
 * @property Foto $foto
 * @property Gallery $gallery
 */
class GalleryFoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%gallery_foto}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['foto_id', 'gallery_id'], 'required'],
            [['foto_id', 'gallery_id'], 'integer'],
            [['foto_id', 'gallery_id'], 'unique', 'targetAttribute' => ['foto_id', 'gallery_id']],
            [['foto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Foto::className(), 'targetAttribute' => ['foto_id' => 'id']],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'foto_id' => Yii::t('app', 'Foto ID'),
            'gallery_id' => Yii::t('app', 'Gallery ID'),
        ];
    }

    /**
     * Gets query for [[Foto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoto()
    {
        return $this->hasOne(Foto::className(), ['id' => 'foto_id']);
    }

    /**
     * Gets query for [[Gallery]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'gallery_id']);
    }
}
