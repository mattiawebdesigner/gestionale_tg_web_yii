<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lns_contest".
 *
 * @property int $id
 * @property int $edizione
 * @property string|null $descrizione
 * @property string $nome
 * @property string $allegato_a 
 * @property string $allegato_b 
 * @property string $allegato_c_maggiorenni 
 * @property string $allegato_c_minorenni 
 *
 * @property Concorrenti[] $concorrentis
 * @property Edizione[] $ediziones
 */
class SnlContest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_contest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['edizione', 'nome'], 'required'],
            [['edizione'], 'integer'],
            [['descrizione'], 'string'],
            [['nome'], 'string', 'max' => 100],
            [['allegato_a', 'allegato_b', 'allegato_c_maggiorenni', 'allegato_c_minorenni', 'regolamento'], 'string', 'max' => 255],             
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'edizione' => Yii::t('app', 'Edizione'),
            'descrizione' => Yii::t('app', 'Descrizione'),
            'nome' => Yii::t('app', 'Nome'),
            'allegato_a' => Yii::t('app', 'Allegato A'), 
            'allegato_b' => Yii::t('app', 'Allegato B'), 
            'allegato_c_maggiorenni' => Yii::t('app', 'Allegato C per i maggiorenni'), 
            'allegato_c_minorenni' => Yii::t('app', 'Allegato C per i minorenni'), 
            'regolamento' => Yii::t('app', 'Regolamento'), 
        ];
    }

    /**
     * Gets query for [[Concorrentis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConcorrentis()
    {
        return $this->hasMany(Concorrenti::className(), ['contest' => 'id']);
    }

    /**
     * Gets query for [[Ediziones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEdiziones()
    {
        return $this->hasMany(Edizione::className(), ['contest' => 'id']);
    }
}
