<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rendiconto".
 *
 * @property int $id
 * @property string $nome
 * @property string $data_inserimento
 * @property string $ultima_modifica
 * @property string $anno
 *
 * @property Anno $anno0
 * @property RendicontoVoci $rendicontoVoci
 */
class Rendiconto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rendiconto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'anno'], 'required'],
            [['data_inserimento', 'ultima_modifica', 'anno'], 'safe'],
            [['nome'], 'string', 'max' => 255],
            [['anno'], 'exist', 'skipOnError' => true, 'targetClass' => Anno::className(), 'targetAttribute' => ['anno' => 'anno']],
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
            'data_inserimento' => Yii::t('app', 'Data Inserimento'),
            'ultima_modifica' => Yii::t('app', 'Ultima Modifica'),
            'anno' => Yii::t('app', 'Anno'),
        ];
    }

    /**
     * Gets query for [[Anno0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnno0()
    {
        return $this->hasOne(Anno::className(), ['anno' => 'anno']);
    }

    /**
     * Gets query for [[RendicontoVoci]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRendicontoVoci()
    {
        return $this->hasOne(RendicontoVoci::className(), ['id_rendiconto' => 'id']);
    }
}
