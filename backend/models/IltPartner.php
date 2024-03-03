<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ilt_foto".
 *
 * @property int $id
 * @property string $partner
 * @property string|null $note
 * @property string $tipo_di_sponsorizzazione
 * @property string $postazioni
 * @property int $ordinamento
 * @property string $logo
 * @property string $sito_internet
 * @property int $festival
 * @property int $tipologia_di_partner
 */
class IltPartner extends \yii\db\ActiveRecord
{
    
    const SPONSOR = 0;
    /*
     * PA e Associazioni
    */
    const PARTNER = 1;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ilt_partner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ordinamento','festival', 'tipologia_di_partner'], 'number'],
            [['partner', 'logo'], 'required'],
            [['note'], 'string'],
            [['partner'], 'string', 'max' => 150],
            [['tipo_di_sponsorizzazione', 'postazioni', 'logo', 'sito_internet'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                    => 'ID',
            'ordinamento'           => Yii::t('app', 'Ordinamento'),
            'festival'              => Yii::t('app', 'Festival'),
            'tipologia_di_partner'  => Yii::t('app', 'Tipologia di partner'),
            'partner'               => Yii::t('app', 'Partner'),
            'note'                  => Yii::t('app', 'Note'),
            'logo'                  => Yii::t('app', 'Logo'),
            'postazioni'            => Yii::t('app', 'Postazioni'),
            'sito_internet'         => Yii::t('app', 'Sito internet'),
        ];
    }
}
