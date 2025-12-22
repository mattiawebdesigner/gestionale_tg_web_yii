<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tg_terms".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 */
class Terms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tg_terms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'slug'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Name' => Yii::t('app', 'Id Verbale'),
            'Slug' => Yii::t('app', 'Allegato'),
        ];
    }
}
