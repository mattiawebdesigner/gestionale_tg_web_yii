<?php

namespace app\models;

use Yii;
use backend\models\IltArticoliCommenti;
use backend\models\IltArticoli;
use backend\models\IltAlbum;
use backend\models\IltFoto;

/**
 * This is the model class for table "{{%ilt_commenti}}".
 *
 * @property int $id
 * @property string $commento
 * @property string $data
 * @property int $approvato 0: Non approvato 1: Da approvare 10: Approvato
 *
 * @property IltAlbum[] $albums
 * @property IltArticoli[] $articolos
 * @property IltFoto[] $fotos
 * @property IltAlbumCommenti[] $iltAlbumCommentis
 * @property IltArticoliCommenti[] $iltArticoliCommentis
 * @property IltCommentiFoto[] $iltCommentiFotos
 */
class IltCommenti extends \yii\db\ActiveRecord
{
    
    const APPROVED = 10;
    const TO_BE_APPROVED = 1;
    const REJECT = 0;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_commenti}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['commento', 'approvato'], 'required'],
            [['data'], 'safe'],
            [['approvato'], 'integer'],
            [['commento'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'commento' => 'Commento',
            'data' => 'Data',
            'approvato' => 'Approvato',
        ];
    }

    /**
     * Gets query for [[Albums]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlbums()
    {
        return $this->hasMany(IltAlbum::className(), ['id' => 'album'])->viaTable('{{%ilt_album_commenti}}', ['commento' => 'id']);
    }

    /**
     * Gets query for [[Articolos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticolos()
    {
        return $this->hasMany(IltArticoli::className(), ['id' => 'articolo'])->viaTable('{{%ilt_articoli_commenti}}', ['commento' => 'id']);
    }

    /**
     * Gets query for [[Fotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFotos()
    {
        return $this->hasMany(IltFoto::className(), ['id' => 'foto'])->viaTable('{{%ilt_commenti_foto}}', ['commento' => 'id']);
    }

    /**
     * Gets query for [[IltAlbumCommentis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltAlbumCommentis()
    {
        return $this->hasMany(IltAlbumCommenti::className(), ['commento' => 'id']);
    }

    /**
     * Gets query for [[IltArticoliCommentis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltArticoliCommentis()
    {
        return $this->hasMany(IltArticoliCommenti::className(), ['commento' => 'id']);
    }

    /**
     * Gets query for [[IltCommentiFotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltCommentiFotos()
    {
        return $this->hasMany(IltCommentiFoto::className(), ['commento' => 'id']);
    }
}
