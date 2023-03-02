<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_album_commenti}}".
 *
 * @property int $album
 * @property int $commento
 *
 * @property IltAlbum $album0
 * @property IltCommenti $commento0
 */
class IltAlbumCommenti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_album_commenti}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['album', 'commento'], 'required'],
            [['album', 'commento'], 'integer'],
            [['album', 'commento'], 'unique', 'targetAttribute' => ['album', 'commento']],
            [['album'], 'exist', 'skipOnError' => true, 'targetClass' => IltAlbum::className(), 'targetAttribute' => ['album' => 'id']],
            [['commento'], 'exist', 'skipOnError' => true, 'targetClass' => IltCommenti::className(), 'targetAttribute' => ['commento' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'album' => Yii::t('app', 'Album'),
            'commento' => Yii::t('app', 'Commento'),
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
     * Gets query for [[Commento0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommento0()
    {
        return $this->hasOne(IltCommenti::className(), ['id' => 'commento']);
    }
}
