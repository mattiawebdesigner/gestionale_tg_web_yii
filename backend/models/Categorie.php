<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%categorie}}".
 *
 * @property int $categoria_id
 * @property string $categoria
 * @property string $descrizione
 *
 * @property Prodotto[] $prodottos
 */
class Categorie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%categorie}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoria'], 'required'],
            [['descrizione'], 'string'],
            [['categoria'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'categoria_id' => Yii::t('app', 'Categoria ID'),
            'categoria' => Yii::t('app', 'Categoria'),
            'descrizione' => Yii::t('app', 'Descrizione'),
        ];
    }

    /**
     * Gets query for [[Prodottos]].
     *
     * @return \yii\db\ActiveQuery|ProdottoQuery
     */
    public function getProdottos()
    {
        return $this->hasMany(Prodotto::className(), ['categoria_id' => 'categoria_id']);
    }

    /**
     * {@inheritdoc}
     * @return CategorieQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategorieQuery(get_called_class());
    }
}
