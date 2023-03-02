<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "voci".
 *
 * @property int $id
 * @property string $voce
 * @property float $prezzo
 * @property string $data_contabile
 * @property string $data_inserimento
 * @property string $ultima_modifica
 * @property string $tipologia
 *
 * @property RendicontoVoci[] $rendicontoVocis
 */
class Voci extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'voci';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['voce', 'data_contabile', 'tipologia'], 'required'],
            [['prezzo'], 'number'],
            [['data_contabile', 'data_inserimento', 'ultima_modifica'], 'safe'],
            [['tipologia'], 'string'],
            [['voce'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'voce' => Yii::t('app', 'Voce'),
            'prezzo' => Yii::t('app', 'Prezzo'),
            'data_contabile' => Yii::t('app', 'Data Contabile'),
            'data_inserimento' => Yii::t('app', 'Data Inserimento'),
            'ultima_modifica' => Yii::t('app', 'Ultima Modifica'),
            'tipologia' => Yii::t('app', 'Tipologia'),
        ];
    }

    /**
     * Gets query for [[RendicontoVocis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRendicontoVocis()
    {
        return $this->hasMany(RendicontoVoci::className(), ['id_voce' => 'id']);
    }
}
