<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_allegati}}".
 *
 * @property int $id
 * @property string $nome
 * @property string $allegato
 *
 * @property IltFestival[] $festivals
 * @property IltFestivalAllegati[] $iltFestivalAllegatis
 * @property IltIscrizioniAllegati[] $iltIscrizioniAllegatis
 * @property IltIscrizioni[] $iscriziones
 */
class IltAllegati extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_allegati}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'allegato'], 'required'],
            [['nome'], 'string', 'max' => 350],
            [['allegato'], 'string', 'max' => 300],
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
            'allegato' => Yii::t('app', 'Allegato'),
        ];
    }

    /**
     * Gets query for [[Festivals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFestivals()
    {
        return $this->hasMany(IltFestival::className(), ['id' => 'festival'])->viaTable('{{%ilt_festival_allegati}}', ['allegato' => 'id']);
    }

    /**
     * Gets query for [[IltFestivalAllegatis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltFestivalAllegatis()
    {
        return $this->hasMany(IltFestivalAllegati::className(), ['allegato' => 'id']);
    }

    /**
     * Gets query for [[IltIscrizioniAllegatis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltIscrizioniAllegatis()
    {
        return $this->hasMany(IltIscrizioniAllegati::className(), ['allegato' => 'id']);
    }

    /**
     * Gets query for [[Iscriziones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIscriziones()
    {
        return $this->hasMany(IltIscrizioni::className(), ['id' => 'iscrizione'])->viaTable('{{%ilt_iscrizioni_allegati}}', ['allegato' => 'id']);
    }
}
