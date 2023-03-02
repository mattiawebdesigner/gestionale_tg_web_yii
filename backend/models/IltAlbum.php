<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_album}}".
 *
 * @property int $id
 * @property string $nome
 * @property string $descrizione
 * @property string $data_creazione
 * @property string $ultima_modifica
 *
 * @property IltCommenti[] $commentos
 * @property IltFoto[] $fotos
 * @property IltAlbumCommenti[] $iltAlbumCommentis
 * @property IltAlbumFoto[] $iltAlbumFotos
 */
class IltAlbum extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_album}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['data_creazione', 'ultima_modifica'], 'safe'],
            [['nome'], 'string', 'max' => 255],
            [['descrizione'], 'string', 'max' => 350],
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
            'descrizione' => Yii::t('app', 'Descrizione'),
            'data_creazione' => Yii::t('app', 'Data Creazione'),
            'ultima_modifica' => Yii::t('app', 'Ultima Modifica'),
        ];
    }

    /**
     * Gets query for [[Commentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentos()
    {
        return $this->hasMany(IltCommenti::className(), ['id' => 'commento'])->viaTable('{{%ilt_album_commenti}}', ['album' => 'id']);
    }

    /**
     * Gets query for [[Fotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFotos()
    {
        return $this->hasMany(IltFoto::className(), ['id' => 'foto'])->viaTable('{{%ilt_album_foto}}', ['album' => 'id']);
    }

    /**
     * Gets query for [[IltAlbumCommentis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltAlbumCommentis()
    {
        return $this->hasMany(IltAlbumCommenti::className(), ['album' => 'id']);
    }

    /**
     * Gets query for [[IltAlbumFotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltAlbumFotos()
    {
        return $this->hasMany(IltAlbumFoto::className(), ['album' => 'id']);
    }
}
