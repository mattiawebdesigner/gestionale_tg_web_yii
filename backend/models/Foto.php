<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%foto}}".
 *
 * @property int $id
 * @property string $url
 * @property string|null $title_text
 * @property string|null $alt_text
 * @property int $posizione
 * @property string $open
 *
 * @property Gallery[] $galleries
 * @property GalleryFoto[] $galleryFotos
 */
class Foto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%foto}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['url', 'posizione'], 'required'],
            [['posizione'], 'integer'],
            [['open'], 'string'],
            [['url', 'descrizione'], 'string', 'max' => 255],
            [['title_text', 'alt_text'], 'string', 'max' => 100],
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
            'title_text' => Yii::t('app', 'Title Text'),
            'alt_text' => Yii::t('app', 'Alt Text'),
            'posizione' => Yii::t('app', 'Posizione'),
            'open' => Yii::t('app', 'Open'),
            'descrizione' => Yii::t('app', 'Descrizione'),
        ];
    }

    /**
     * Gets query for [[Galleries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGalleries()
    {
        return $this->hasMany(Gallery::className(), ['id' => 'gallery_id'])->viaTable('{{%gallery_foto}}', ['foto_id' => 'id']);
    }

    /**
     * Gets query for [[GalleryFotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGalleryFotos()
    {
        return $this->hasMany(GalleryFoto::className(), ['foto_id' => 'id']);
    }
}
