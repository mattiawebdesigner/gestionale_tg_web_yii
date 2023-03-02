<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%documentazione_categorie}}".
 *
 * @property int $id
 * @property string $categoria
 */
class DocumentazioneCategorie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%documentazione_categorie}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoria'], 'required'],
            [['categoria'], 'string', 'max' => 50],
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
        ];
    }

    /**
     * {@inheritdoc}
     * @return DocumentazioneCategorieQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocumentazioneCategorieQuery(get_called_class());
    }
}
