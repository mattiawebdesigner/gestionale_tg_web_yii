<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tg_terms".
 *
 * @property int $id
 * @property int $term_id
 * @property int $taxonomy
 * @property string $description
 * @property int $count
 * @property int $parent
 */
class TermTaxonomy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tg_term_taxonomy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['term_id', 'taxonomy'], 'required'],
            [['term_id', 'count', 'parent'], 'integer'],
            [['description', 'taxonomy'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'term_id' => Yii::t('app', 'Term ID'),
            'taxonomy' => Yii::t('app', 'Taxonomy'),
            'description' => Yii::t('app', 'Descrizione'),
            'count' => Yii::t('app', 'Count'),
            'parent' => Yii::t('app', 'Parent'),
        ];
    }
}
