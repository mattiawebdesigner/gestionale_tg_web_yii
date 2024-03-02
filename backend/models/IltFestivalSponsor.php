<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ilt_foto".
 *
 * @property int $festival
 * @property int $sponsor
 *
 * @property IltSponsor $sponsor0
 * @property IltFestival $festival0
 */
class IltFestivalSponsor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ilt_festival_sponsor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sponsor', 'festival'], 'required'],
            [['sponsor'], 'exist', 'skipOnError' => true, 'targetClass' => IltSponsor::className(), 'targetAttribute' => ['sponsor' => 'id']],
            [['festival'], 'exist', 'skipOnError' => true, 'targetClass' => \backend\models\IltFestival::className(), 'targetAttribute' => ['festival' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sponsor'   => Yii::t('app', 'Sponsor'),
            'festival'       => Yii::t('app', 'Festival'),
        ];
    }
}
