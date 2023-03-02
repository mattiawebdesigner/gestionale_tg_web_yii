<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ilt_foto".
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
class IltPlatea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ilt_platea';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fila'], 'required'],
            [['nome_fila'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_fila' => Yii::t('app', 'Nome della fila'),
        ];
    }
    
    /**
     * Gets query for [[Fila]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasMany(IltFila::className(), ['id' => 'fila']);
    }
}
