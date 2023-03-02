<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%prodotto}}".
 *
 * @property int $id
 * @property string $nome
 * @property int $categoria_id
 * @property string $descrizione
 * @property int $quantita
 * @property string $data_inserimento
 * @property int $proprietario_id
 *
 * @property Categorie $categoria
 * @property Immagini[] $immaginis
 * @property Proprietario $proprietario
 */
class Prodotto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%prodotto}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'categoria_id', 'descrizione', 'quantita', 'proprietario_id'], 'required'],
            [['categoria_id', 'quantita', 'proprietario_id'], 'integer'],
            [['descrizione'], 'string'],
            [['data_inserimento'], 'safe'],
            [['nome'], 'string', 'max' => 50],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorie::className(), 'targetAttribute' => ['categoria_id' => 'categoria_id']],
            [['proprietario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Proprietario::className(), 'targetAttribute' => ['proprietario_id' => 'id']],
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
            'categoria_id' => Yii::t('app', 'Categoria ID'),
            'descrizione' => Yii::t('app', 'Descrizione'),
            'quantita' => Yii::t('app', 'Quantita'),
            'data_inserimento' => Yii::t('app', 'Data Inserimento'),
            'proprietario_id' => Yii::t('app', 'Proprietario ID'),
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery|CategorieQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categorie::className(), ['categoria_id' => 'categoria_id']);
    }

    /**
     * Gets query for [[Immaginis]].
     *
     * @return \yii\db\ActiveQuery|ImmaginiQuery
     */
    public function getImmaginis()
    {
        return $this->hasMany(Immagini::className(), ['prodotto_id' => 'id']);
    }

    /**
     * Gets query for [[Proprietario]].
     *
     * @return \yii\db\ActiveQuery|ProprietarioQuery
     */
    public function getProprietario()
    {
        return $this->hasOne(Proprietario::className(), ['id' => 'proprietario_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProdottoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProdottoQuery(get_called_class());
    }
}
