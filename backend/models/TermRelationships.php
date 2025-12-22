<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tg_terms".
 *
 * @property int $id
 * @property int $object_id
 * @property int $term_taxonomy_id
 */
class TermRelationships extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tg_term_relationships';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['object_id', 'term_taxonomy_id'], 'required'],
            [['object_id', 'term_taxonomy_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
        ];
    }
}
