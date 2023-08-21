<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ilt_foto".
 *
 * @property int $id
 * @property string $spettacolo
 * @property date $data
 * @property time $ora_porta
 * @property time $ora_sipario
 * @property string $banner
 * @property string $locandina
 * @property string $sinossi
 * @property int $festival
 */
class IltSpettacolo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ilt_spettacolo';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['spettacolo', 'data', 'ora_porta', 'ora_sipario'], 'required'],
            [['spettacolo', 'banner', 'locandina', 'sinossi'], 'string'],
            [['festival'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'spettacolo' => Yii::t('app', 'Spettacolo'),
            'data' => Yii::t('app', 'Data dello spettacolo'),
            'ora_porta' => Yii::t('app', 'Apertura porte'),
            'ora_sipario' => Yii::t('app', 'Inizio dello spettacolo'),
            'banner' => Yii::t('app', 'Banner spettacolo'),
            'locandina' => Yii::t('app', 'Locandina dello spettacolo'),
            'sinossi' => Yii::t('app', 'Sinossi dello spettacolo'),
            'festival' => Yii::t('app', 'Festival'),
        ];
    }
}
