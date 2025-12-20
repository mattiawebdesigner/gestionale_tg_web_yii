<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tg_postmeta".
 *
 * @property int $meta_id
 * @property int $post_id
 * @property string $meta_key
 * @property string $post_date_gmt
 * @property string $meta_value
 */
class Postmeta extends \yii\db\ActiveRecord
{
    /**
     * menu_key => [
     *  menu_value => [
     *      type_field => url|select (from database)|other
     *  ]
     * ]
     * 
     * @var array
     */
    public static $menu_info = [
        '_menu_item_type' => [
            'custom' => [
                'text' => 'URL personalizzato',
                'type' => 'url'
            ],
            'post_type' => [
                'text' => 'Articolo specifico',
                'type' => 'dropdown|posts'//tipo select recuperando i dati dalla tabella posts
            ],
            'who_we_are' => [
                'text'  => 'Chi siamo',
                'type'  => false,//non preleve i dati da nessuna tabella ne da altro, utilizza un URL specifico
                'url'   => 'https://www.teatralmentegioia.it/tg/public/site/who-we-are#features'
            ],
            'next_time' => [
                'text'  => 'Prossimamente',
                'type'  => false,//non preleve i dati da nessuna tabella ne da altro, utilizza un URL specifico
                'url'   => 'https://www.teatralmentegioia.it/tg/public/site/prossimamente#soon'
            ],
            'conctact_us' => [
                'text'  => 'Contattaci',
                'type'  => false,//non preleve i dati da nessuna tabella ne da altro, utilizza un URL specifico
                'url'   => 'https://www.teatralmentegioia.it/tg/public/index#contactus'
            ],
        ],
    ];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tg_postmeta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meta_key', 'post_id'], 'required'],
            [['meta_key', 'meta_value'], 'string'],
            [['post_id'], 'integer'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'meta_key' => Yii::t('app', 'Meta Key'),
            'meta_value' => Yii::t('app', 'Meta Value'),
            'post_id' => Yii::t('app', 'Post ID'),
        ];
    }
}
