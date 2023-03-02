<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "social".
 *
 * @property int $id
 * @property string $social
 * @property string $icona Icona fontawesome
 *
 * @property IntestazioneSocial[] $intestazioneSocials
 * @property Intestazione[] $intestaziones
 */
class Social extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'social';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['social', 'icona'], 'required'],
            [['social', 'icona'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'social' => Yii::t('app', 'Social'),
            'icona' => Yii::t('app', 'Icona'),
        ];
    }

    /**
     * Gets query for [[IntestazioneSocials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIntestazioneSocials()
    {
        return $this->hasMany(IntestazioneSocial::className(), ['id_social' => 'id']);
    }

    /**
     * Gets query for [[Intestaziones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIntestaziones()
    {
        return $this->hasMany(Intestazione::className(), ['id' => 'id_intestazione'])->viaTable('intestazione_social', ['id_social' => 'id']);
    }
}
