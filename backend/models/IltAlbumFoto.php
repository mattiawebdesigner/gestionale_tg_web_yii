<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_album_foto}}".
 *
 * @property int $album
 * @property int $foto
 *
 * @property IltAlbum $album0
 * @property IltFoto $foto0
 */
class IltAlbumFoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_album_foto}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['album', 'foto'], 'required'],
            [['album', 'foto'], 'integer'],
            [['album', 'foto'], 'unique', 'targetAttribute' => ['album', 'foto']],
            [['album'], 'exist', 'skipOnError' => true, 'targetClass' => IltAlbum::className(), 'targetAttribute' => ['album' => 'id']],
            [['foto'], 'exist', 'skipOnError' => true, 'targetClass' => IltFoto::className(), 'targetAttribute' => ['foto' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'album' => Yii::t('app', 'Album'),
            'foto' => Yii::t('app', 'Foto'),
        ];
    }

    /**
     * Gets query for [[Album0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlbum0()
    {
        return $this->hasOne(IltAlbum::className(), ['id' => 'album']);
    }

    /**
     * Gets query for [[Foto0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFoto0()
    {
        return $this->hasOne(IltFoto::className(), ['id' => 'foto']);
    }
}
