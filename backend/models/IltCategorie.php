<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_categorie}}".
 *
 * @property int $id
 * @property string $categoria
 * @property int|null $categorie_padre
 *
 * @property IltCategorie $categoriePadre
 * @property IltArticoli[] $iltArticolis
 * @property IltCategorie[] $iltCategories
 */
class IltCategorie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_categorie}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoria'], 'required'],
            [['categorie_padre'], 'integer'],
            [['categoria'], 'string', 'max' => 255],
            [['categorie_padre'], 'exist', 'skipOnError' => true, 'targetClass' => IltCategorie::className(), 'targetAttribute' => ['categorie_padre' => 'id']],
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
            'categorie_padre' => Yii::t('app', 'Categorie Padre'),
        ];
    }

    /**
     * Gets query for [[CategoriePadre]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriePadre()
    {
        return $this->hasOne(IltCategorie::className(), ['id' => 'categorie_padre']);
    }

    /**
     * Gets query for [[IltArticolis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltArticolis()
    {
        return $this->hasMany(IltArticoli::className(), ['categoria' => 'id']);
    }

    /**
     * Gets query for [[IltCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltCategories()
    {
        return $this->hasMany(IltCategorie::className(), ['categorie_padre' => 'id']);
    }
}
