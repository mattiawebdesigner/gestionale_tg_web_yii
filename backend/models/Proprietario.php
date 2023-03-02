<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%proprietario}}".
 *
 * @property int $id
 * @property string $proprietario
 *
 * @property Prodotto[] $prodottos
 */
class Proprietario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%proprietario}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proprietario'], 'required'],
            [['proprietario'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'proprietario' => Yii::t('app', 'Proprietario'),
        ];
    }

    /**
     * Gets query for [[Prodottos]].
     *
     * @return \yii\db\ActiveQuery|ProdottoQuery
     */
    public function getProdottos()
    {
        return $this->hasMany(Prodotto::className(), ['proprietario_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProprietarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProprietarioQuery(get_called_class());
    }
}
