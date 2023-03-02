<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "partner".
 *
 * @property int $id
 * @property string $partner
 * @property string|null $note
 * @property string $tipo_di_sponsorizzazione
 * @property string $postazioni
 * @property int $ordinamento
 * @property string $logo
 * @property string $sito_internet
 * @property int $contest
 * @tipologia_di_partner 0: sponsor
 *                       1: partner pubbliche amministrazioni o associazioni
 *
 * @property Contest $contest0
 */
class SnlPartner extends \yii\db\ActiveRecord
{
    const SPONSOR = 0;
    const PA_ASSOCIAZIONI = 1;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_partner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partner', 'tipo_di_sponsorizzazione', 'postazioni', 'ordinamento', 'contest'], 'required'],
            [['note'], 'string'],
            [['ordinamento', 'contest', 'tipologia_di_partner'], 'integer'],
            [['partner'], 'string', 'max' => 150],
            [['tipo_di_sponsorizzazione', 'postazioni', 'logo', 'sito_internet'], 'string', 'max' => 255],
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
            'partner' => Yii::t('app', 'Partner'),
            'note' => Yii::t('app', 'Note'),
            'tipo_di_sponsorizzazione' => Yii::t('app', 'Tipo Di Sponsorizzazione'),
            'postazioni' => Yii::t('app', 'Postazioni'),
            'ordinamento' => Yii::t('app', 'Ordinamento'),
            'logo' => Yii::t('app', 'Logo'),
            'sito_internet' => Yii::t('app', 'Sito Internet dell\'attività'),
            'contest' => Yii::t('app', 'Contest'),
            'tipologia_di_partner' => Yii::t('app', 'Tiologia di partner'),
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
