<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lns_stand_alimentari".
 *
 * @property int $id
 * @property string $nome
 * @property string $tipologia Tipologia di stand, per esempio: crepes
 * @property int $n_postazione
 * @property string $dimensione
 * @property string|null $logo
 * @property int $contest
 *
 * @property LnsContest $contest0
 */
class SnlStandAlimentari extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_stand_alimentari';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'tipologia', 'n_postazione', 'dimensione', 'contest'], 'required'],
            [['n_postazione', 'contest'], 'integer'],
            [['nome'], 'string', 'max' => 100],
            [['tipologia'], 'string', 'max' => 45],
            [['dimensione'], 'string', 'max' => 20],
            [['logo'], 'string', 'max' => 255],
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
            'nome' => Yii::t('app', 'Nome'),
            'tipologia' => Yii::t('app', 'Tipologia di stand, per esempio: crepes'),
            'n_postazione' => Yii::t('app', 'N Postazione'),
            'dimensione' => Yii::t('app', 'Dimensione'),
            'logo' => Yii::t('app', 'Logo'),
            'contest' => Yii::t('app', 'Contest'),
        ];
    }

    /**
     * Gets query for [[Contest0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContest0()
    {
        return $this->hasOne(SnlContest::className(), ['id' => 'contest']);
    }
}
