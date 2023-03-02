<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_festival}}".
 *
 * @property int $id
 * @property string $anno
 * @property string $inizio
 * @property string $fine
 * @property string $edizione
 * @property string|null $inizio_pubblicazione
 * @property string|null $fine_pubblicazione
 * @property string $regolamenti
 *
 * @property IltIscrizioni[] $iltIscrizionis
 */
class IltFestival extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_festival}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anno', 'inizio', 'fine', 'edizione', 'regolamenti'], 'required'],
            [['anno', 'inizio', 'fine', 'inizio_pubblicazione', 'fine_pubblicazione'], 'safe'],
            [['edizione'], 'string', 'max' => 15],
            [['regolamenti'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'anno' => Yii::t('app', 'Anno'),
            'inizio' => Yii::t('app', 'Inizio del festival'),
            'fine' => Yii::t('app', 'Fine del festival'),
            'edizione' => Yii::t('app', 'Edizione'),
            'inizio_pubblicazione' => Yii::t('app', 'Inizio Pubblicazione'),
            'fine_pubblicazione' => Yii::t('app', 'Fine Pubblicazione'),
            'regolamenti' => Yii::t('app', 'Regolamenti'),
        ];
    }
    
    /** 
     * Gets query for [[Allegatos]]. 
     * 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getAllegatos() 
    { 
        return $this->hasMany(IltAllegati::className(), ['id' => 'allegato'])->viaTable('{{%ilt_festival_allegati}}', ['festival' => 'id']); 
    } 

    /** 
     * Gets query for [[IltFestivalAllegatis]]. 
     * 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getIltFestivalAllegatis() 
    { 
        return $this->hasMany(IltFestivalAllegati::className(), ['festival' => 'id']); 
    }
    
    /**
     * Gets query for [[IltIscrizionis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltIscrizionis()
    {
        return $this->hasMany(IltIscrizioni::className(), ['festival' => 'id']);
    }
}
