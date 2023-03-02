<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categorie".
 *
 * @property int $categoria_id
 * @property string $categoria
 * @property string|null $descrizione
 */
class SnlCategorie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_categorie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoria'], 'required'],
            [['categoria_padre'], 'integer'],
            [['categoria'], 'string', 'max' => 255],
            [['categoria_padre'], 'exist', 'skipOnError' => true, 'targetClass' => SnlCategorie::className(), 'targetAttribute' => ['categoria_padre' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'categoria' => Yii::t('app', 'Categoria'),
            'categoria_padre' => Yii::t('app', 'Categoria Padre'),
        ];
    }

    /**
     * Gets query for [[Articolis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticolis()
    {
        return $this->hasMany(Articoli::className(), ['categoria' => 'id']);
    }

    /**
     * Gets query for [[CategoriaPadre]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaPadre()
    {
        return $this->hasOne(Categorie::className(), ['id' => 'categoria_padre']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categorie::className(), ['categoria_padre' => 'id']);
    }
}
