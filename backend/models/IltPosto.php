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
class IltPosto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ilt_posto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'posto', 'fila', 'tipo_di_seduta'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'posto' => Yii::t('app', 'Posto'),
            'fila' => Yii::t('app', 'Fila'),
            'seduta' => Yii::t('app', 'Seduta'),
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
    
    public function getPlatea() {
        return $this->hasMany(IltFila::className(), ['nome_fila' => 'fila'])->viaTable('ilt_platea', ['fila' => 'fila']);
    }
    
}
