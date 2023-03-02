<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_premi}}".
 *
 * @property int $id
 * @property string $premio
 * @property string $nome
 * @property string|null $icona
 *
 * @property IltFestival[] $festivals
 * @property IltPremiFestival[] $iltPremiFestivals
 * @property IltVincitori[] $iltVincitoris
 * @property IltIscrizioni[] $iscriziones
 */
class IltPremi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_premi}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['premio', 'nome'], 'required'],
            [['premio', 'nome'], 'string', 'max' => 155],
            [['icona'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'premio' => Yii::t('app', 'Premio'),
            'nome' => Yii::t('app', 'Nome'),
            'icona' => Yii::t('app', 'Icona'),
        ];
    }

    /**
     * Gets query for [[Festivals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFestivals()
    {
        return $this->hasMany(IltFestival::className(), ['id' => 'festival'])->viaTable('{{%ilt_premi_festival}}', ['premio' => 'id']);
    }

    /**
     * Gets query for [[IltPremiFestivals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltPremiFestivals()
    {
        return $this->hasMany(IltPremiFestival::className(), ['premio' => 'id']);
    }

    /**
     * Gets query for [[IltVincitoris]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIltVincitoris()
    {
        return $this->hasMany(IltVincitori::className(), ['premio' => 'id']);
    }

    /**
     * Gets query for [[Iscriziones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIscriziones()
    {
        return $this->hasMany(IltIscrizioni::className(), ['id' => 'iscrizione'])->viaTable('{{%ilt_vincitori}}', ['premio' => 'id']);
    }
}
