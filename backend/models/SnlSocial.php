<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lns_nominativi".
 *
 * @property int $id
 * @property string $social
 * @property string $icona
 * @property string $link
 *
 * @property Concorrenti $concorrente0
 */
class SnlSocial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_social';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['id'], 'integer'],
            //[['social', 'icona', 'link'], 'required'],
            [['link'], 'string', 'max' => 100],
            [['social', 'icona', ], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'social' => Yii::t('app', 'Nome del social'),
            'icona' => Yii::t('app', 'Icona (fontawesome)'),
            'link' => Yii::t('app', 'Link'),
        ];
    }
}
