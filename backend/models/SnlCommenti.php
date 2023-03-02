<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lns_commenti".
 *
 * @property int $id
 * @property string $commento
 * @property string $data
 * @property int $approvato 0: Non approvato 1: Da approvare 10: Approvato
 *
 * @property Articoli[] $articolis
 */
class SnlCommenti extends \yii\db\ActiveRecord
{
    const APPROVED          = 10;
    const REJECTED          = 0;
    const TO_BE_APPROVED    = 1;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_commenti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['commento'], 'required'],
            [['data'], 'safe'],
            [['approvato'], 'integer'],
            [['commento'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'commento' => Yii::t('app', 'Commento'),
            'data' => Yii::t('app', 'Data'),
            'approvato' => Yii::t('app', 'Approvato'),
        ];
    }

    /**
     * Gets query for [[IltArticoliCommentis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltArticoliCommentis()
    {
        return $this->hasMany(SnlArticoliCommenti::className(), ['commento' => 'id']);
    }

    /**
     * Gets query for [[Articolos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticolis()
    {
        return $this->hasMany(SnlArticoli::className(), ['id' => 'articolo'])->viaTable('lns_articoli_commenti', ['commento' => 'id']);
    }
}
