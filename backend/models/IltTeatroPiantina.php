<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ilt_premi}}".
 *
 * @property int $id
 * @property string $teatro
 * @property string $piantina
 */
class IltTeatroPiantina extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ilt_teatro_piantina}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teatro', 'piantina'], 'required'],
            [['teatro'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'teatro' => Yii::t('app', 'Teatro'),
            'piantina' => Yii::t('app', 'Piantina'),
        ];
    }
}
