<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_foto}}".
 *
 * @property int $id
 * @property string $url
 * @property string|null $alt_text
 * @property string|null $title_text
 * @property int $posizione
 * @property string|null $descrizione
 *
 * @property IltAlbum[] $albums
 * @property IltCommenti[] $commentos
 * @property IltAlbumFoto[] $iltAlbumFotos
 * @property IltCommentiFoto[] $iltCommentiFotos
 */
class IltFoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_foto}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['posizione'], 'required'],
            [['posizione'], 'integer'],
            [['url'], 'string', 'max' => 300],
            [['alt_text', 'title_text'], 'string', 'max' => 80],
            [['descrizione'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'alt_text' => Yii::t('app', 'Alt Text'),
            'title_text' => Yii::t('app', 'Title Text'),
            'posizione' => Yii::t('app', 'Posizione'),
            'descrizione' => Yii::t('app', 'Descrizione'),
        ];
    }

    /**
     * Gets query for [[Albums]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(IltAlbum::className(), ['id' => 'album'])->viaTable('{{%ilt_album_foto}}', ['foto' => 'id']);
    }

    /**
     * Gets query for [[Commentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentos()
    {
        return $this->hasMany(IltCommenti::className(), ['id' => 'commento'])->viaTable('{{%ilt_commenti_foto}}', ['foto' => 'id']);
    }

    /**
     * Gets query for [[IltAlbumFotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltAlbumFotos()
    {
        return $this->hasMany(IltAlbumFoto::className(), ['foto' => 'id']);
    }

    /**
     * Gets query for [[IltCommentiFotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltCommentiFotos()
    {
        return $this->hasMany(IltCommentiFoto::className(), ['foto' => 'id']);
    }
}
