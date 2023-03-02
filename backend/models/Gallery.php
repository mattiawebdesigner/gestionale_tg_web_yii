<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%gallery}}".
 *
 * @property int $id
 * @property string $nome
 * @property string|null $descrizione
 * @property string $tipo
 * @property string $data_creazione
 * @property string $ultima_modifica
 * @property int $sito_di_riferimento
 *
 * @property Foto[] $fotos
 * @property GalleryFoto[] $galleryFotos
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * Display gallery on main site
     */
    const SITE_MAIN = 0;
    /**
     * Display gallery on I Love Teatro site
     */
    const SITE_I_LOVE_TEATRO = 1;
    /**
     * Display gallery on San Lorenzo site
     */
    const SITE_SAN_LORENZO = 2;
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%gallery}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'tipo'], 'required'],
            [['sito_di_riferimento'], 'integer'],
            [['tipo',], 'string'],
            [['data_creazione', 'ultima_modifica'], 'safe'],
            [['nome'], 'string', 'max' => 100],
            [['descrizione'], 'string', 'max' => 1000],
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
            'tipo' => Yii::t('app', 'Tipo'),
            'data_creazione' => Yii::t('app', 'Data Creazione'),
            'ultima_modifica' => Yii::t('app', 'Ultima Modifica'),
            'sito_di_riferimento' => Yii::t('app', 'Sito di riferimento'),
        ];
    }

    /**
     * Gets query for [[Fotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFotos()
    {
        return $this->hasMany(Foto::className(), ['id' => 'foto_id'])->viaTable('{{%gallery_foto}}', ['gallery_id' => 'id']);
    }

    /**
     * Gets query for [[GalleryFotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGalleryFotos()
    {
        return $this->hasMany(GalleryFoto::className(), ['gallery_id' => 'id']);
    }
}
