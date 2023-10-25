<?php

namespace backend\models;

use Yii;
use backend\models\Soci;

/**
 * This is the model class for table "{{%soci}}".
 *
 * @property int $id
 * @property int $socio
 * @property string $firma
 * @property string $data_inserimento
 * @property string $ultima_modifica
 *
 * @property Soci[] $soci
 */
class Firma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%firma}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_inserimento', 'ultima_modifica'], 'safe'],
            [['firma'], 'string', 'max' => 255],
            [['socio'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'socio' => Yii::t('app', 'Socio'),
            'firma' => Yii::t('app', 'Firma autografa'),
            'data_inserimento' => Yii::t('app', 'Data di inserimento'),
            'ultima_modifica' => Yii::t('app', 'Ultima modifica'),
        ];
    }

    /**
     * Gets query for [[Annos]].
     *
     * @return \yii\db\ActiveQuery|AnnoSocialeQuery
     */
    public function getSoci()
    {
        return $this->hasMany(Soci::className(), ['socio' => 'id']);
    }
    
}
