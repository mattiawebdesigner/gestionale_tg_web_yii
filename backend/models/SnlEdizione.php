<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lns_edizione".
 *
 * @property int $id
 * @property int $edizione
 * @property string $anno
 * @property string $nome
 * @property int $contest
 *
 * @property Contest $contest0
 */
class SnlEdizione extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_edizione';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['edizione', 'nome', 'descrizione'], 'required'],
            [['edizione', 'contest'], 'integer'],
            [['anno'], 'safe'],
            [['nome'], 'string', 'max' => 100],
            [['descrizione'], 'string'],
            [['contest'], 'exist', 'skipOnError' => true, 'targetClass' => SnlContest::className(), 'targetAttribute' => ['contest' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'edizione' => Yii::t('app', 'Edizione'),
            'anno' => Yii::t('app', 'Anno'),
            'nome' => Yii::t('app', 'Nome'),
            'contest' => Yii::t('app', 'Contest'),
            'descrizione' => Yii::t('app', 'Descrizione'),
        ];
    }

    /**
     * Gets query for [[Contest0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContest0()
    {
        return $this->hasOne(Contest::className(), ['id' => 'contest']);
    }
}
