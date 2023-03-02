<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%immagini}}".
 *
 * @property int $id
 * @property string $link
 * @property int $prodotto_id
 *
 * @property Prodotto $prodotto
 */
class Immagini extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%immagini}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link', 'prodotto_id'], 'required'],
            [['prodotto_id'], 'integer'],
            [['link'], 'string', 'max' => 255],
            [['prodotto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prodotto::className(), 'targetAttribute' => ['prodotto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'link' => Yii::t('app', 'Link'),
            'prodotto_id' => Yii::t('app', 'Prodotto ID'),
        ];
    }

    /**
     * Gets query for [[Prodotto]].
     *
     * @return \yii\db\ActiveQuery|ProdottoQuery
     */
    public function getProdotto()
    {
        return $this->hasOne(Prodotto::className(), ['id' => 'prodotto_id']);
    }

    /**
     * {@inheritdoc}
     * @return ImmaginiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImmaginiQuery(get_called_class());
    }
}
