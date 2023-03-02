<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "intestazione_social".
 *
 * @property int $id_intestazione
 * @property int $id_social
 *
 * @property Intestazione $intestazione
 * @property Social $social
 */
class IntestazioneSocial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'intestazione_social';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_intestazione', 'id_social'], 'required'],
            [['id_intestazione', 'id_social'], 'integer'],
            [['id_intestazione', 'id_social'], 'unique', 'targetAttribute' => ['id_intestazione', 'id_social']],
            [['id_intestazione'], 'exist', 'skipOnError' => true, 'targetClass' => Intestazione::className(), 'targetAttribute' => ['id_intestazione' => 'id']],
            [['id_social'], 'exist', 'skipOnError' => true, 'targetClass' => Social::className(), 'targetAttribute' => ['id_social' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_intestazione' => Yii::t('app', 'Id Intestazione'),
            'id_social' => Yii::t('app', 'Id Social'),
        ];
    }

    /**
     * Gets query for [[Intestazione]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIntestazione()
    {
        return $this->hasOne(Intestazione::className(), ['id' => 'id_intestazione']);
    }

    /**
     * Gets query for [[Social]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSocial()
    {
        return $this->hasOne(Social::className(), ['id' => 'id_social']);
    }
}
