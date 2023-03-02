<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_articoli}}".
 *
 * @property int $id
 * @property string $titolo
 * @property string $contenuto
 * @property string $data_pubblicazione
 * @property string|null $inizio_pubblicazione
 * @property string|null $fine_pubblicazione
 * @property string $immagine_in_evidenza
 * @property string|null $meta_description
 * @property string|null $meta_keyword
 * @property string $commenti
 * @property int|null $categoria
 * @property int $pubblicato
 *
 * @property IltCategorie $categoria0
 * @property IltCommenti[] $commentos
 * @property IltArticoliCommenti[] $iltArticoliCommentis
 */
class IltArticoli extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_articoli}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titolo', 'contenuto'], 'required'],
            [['contenuto'], 'string'],
            [['data_pubblicazione', 'inizio_pubblicazione', 'fine_pubblicazione'], 'safe'],
            [['categoria', 'commenti', 'pubblicato'], 'integer'],
            [['titolo'], 'string', 'max' => 255],
            [['immagine_in_evidenza'], 'string', 'max' => 300],
            [['meta_description', 'meta_keyword'], 'string', 'max' => 100],
            [['categoria'], 'exist', 'skipOnError' => true, 'targetClass' => IltCategorie::className(), 'targetAttribute' => ['categoria' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'titolo' => Yii::t('app', 'Titolo'),
            'contenuto' => Yii::t('app', 'Contenuto'),
            'data_pubblicazione' => Yii::t('app', 'Data Pubblicazione'),
            'inizio_pubblicazione' => Yii::t('app', 'Inizio Pubblicazione'),
            'fine_pubblicazione' => Yii::t('app', 'Fine Pubblicazione'),
            'immagine_in_evidenza' => Yii::t('app', 'Immagine In Evidenza'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keyword' => Yii::t('app', 'Meta Keyword'),
            'commenti' => Yii::t('app', 'Commenti'),
            'categoria' => Yii::t('app', 'Categoria'),
        ];
    }

    /**
     * Gets query for [[Categoria0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria0()
    {
        return $this->hasOne(IltCategorie::className(), ['id' => 'categoria']);
    }

    /**
     * Gets query for [[Commentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommentos()
    {
        return $this->hasMany(IltCommenti::className(), ['id' => 'commento'])->viaTable('{{%ilt_articoli_commenti}}', ['articolo' => 'id']);
    }

    /**
     * Gets query for [[IltArticoliCommentis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltArticoliCommentis()
    {
        return $this->hasMany(IltArticoliCommenti::className(), ['articolo' => 'id']);
    }
}
