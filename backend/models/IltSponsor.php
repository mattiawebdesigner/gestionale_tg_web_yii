<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ilt_foto".
 *
 * @property int $id
 * @property string|null $url
 * @property string $immagine
 * @property string $sponsor
 */
class IltSponsor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ilt_sponsor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sponsor', 'immagine'], 'required'],
            [['sponsor', 'immagine', 'url'], 'string'],
            [['url', 'immagine'], 'string', 'max' => 255],
            [['sponsor'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'        => 'ID',
            'sponsor'   => Yii::t('app', 'Sponsor'),
            'url'       => Yii::t('app', 'Url'),
            'immagine'  => Yii::t('app', 'Immagine'),
        ];
    }
}
