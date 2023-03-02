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
class IltOrdine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ilt_ordine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ordine'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ordine' => Yii::t('app', 'Ordine'),
        ];
    }
}
