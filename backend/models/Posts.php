<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tg_posts".
 *
 * @property int $id
 * @property int $post_author
 * @property string $post_date
 * @property string $post_date_gmt
 * @property string $post_content
 * @property string $post_title
 * @property string $comment_status
 * @property string $post_modified
 * @property string $post_modified_gmt
 * @property string $post_type
 * @property string $post_mime_type
 * @property int $ordering
 * @property int $featured
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tg_posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_author', 'post_date_gmt', 'post_content', 'post_title', 'post_modified_gmt', 'post_type'], 'required'],
            [['post_author', 'comment_status', 'ordering', 'featured'], 'integer'],
            [['post_content', 'post_title'], 'string'],
            [['post_modified', 'post_modified_gmt', 'post_date', 'post_date_gmt'], 'date', 'format' => 'php:Y-m:d H:i:s'],
            [['post_type'], 'string', 'max' => 255],
            [['post_mime_type'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_author' => Yii::t('app', 'Autore'),
            'post_date' => Yii::t('app', 'Data di pubblicazione'),
            'post_date_gmt' => Yii::t('app', 'Data di pubblicazione GMT'),
            'post_content' => Yii::t('app', 'Contenuto'),
            'post_title' => Yii::t('app', 'Titolo'),
            'comment_status' => Yii::t('app', 'Stato del commento'),
            'post_modified' => Yii::t('app', 'Ultima modifica'),
            'post_modified_gmt' => Yii::t('app', 'Ultima modifica GMT'),
            'post_type' => Yii::t('app', 'Tipo di post'),
            'post_mime_type' => Yii::t('app', 'Mime Type'),
            'ordering' => Yii::t('app', 'Ordinamento'),
            'featured' => Yii::t('app', 'In primo piano'),
        ];
    }
}
