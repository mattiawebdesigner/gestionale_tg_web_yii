<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%votazione_has_voti}}".
 *
 * @property int $id
 * @property string $id_verbale
 *
 * @property Verbali $verbale
 */
class VotazioneHasVoti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%votazione_has_voti}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_voto','id_votazione'], 'required'],
            [['id_voto', 'id_votazione'],'number'],
            [['id_votazione'], 'exist', 'skipOnError' => true, 'targetClass' => Votazione::className(), 'targetAttribute' => ['id_votazione' => 'id']],
            [['id_voto'], 'exist', 'skipOnError' => true, 'targetClass' => Voti::className(), 'targetAttribute' => ['id_voto' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_voto' => Yii::t('app', 'Voto'),
            'id_votazione' => Yii::t('app', 'Votazione'),
        ];
    }

    /**
     * Gets query for [[Votazione]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVotazione()
    {
        return $this->hasOne(Votazione::className(), ['id_votazione' => 'id']);
    }

    /**
     * Gets query for [[Voto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVoto()
    {
        return $this->hasOne(Voto::className(), ['id_voto' => 'id']);
    }
}
