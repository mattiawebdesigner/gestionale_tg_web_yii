<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "utenti".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $email
 * @property string $password
 * @property string $data_di_registrazione
 * @property string|null $data_ultima_modifica
 * @property string|null $indirizzo
 * @property int $status
 *               Stato dell'utente.
 *               0 = Deleted, 9 = Inactive, 10 = Active
 * @property string $socio_id
 * @property string $reset_auth_key
 *                  Chiave di validazione reset password. Formato: TIMESTAMP_IDUTENTE
 */
class Utenti extends \yii\db\ActiveRecord
{
    public $repeat_password;
    
    public static $ACTIVE = 10;
    public static $INACTIVE = 9;
    public static $DELETED = 0;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%utenti}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cognome', 'email', 'password', 'repeat_password', 'socio_id'], 'required'],
            [['data_di_registrazione', 'data_ultima_modifica'], 'safe'],
            [['nome', 'cognome'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 150],
            [['password', 'repeat_password', 'reset_auth_key'], 'string', 'max' => 255],
            [['indirizzo'], 'string', 'max' => 120],
            [['status'], 'integer'],
            ['repeat_password', 'compare', 'compareAttribute'=>'password', 'message' => Yii::t('app', 'Le password non coincidono')],
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
            'cognome' => Yii::t('app', 'Cognome'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'data_di_registrazione' => Yii::t('app', 'Data Di Registrazione'),
            'data_ultima_modifica' => Yii::t('app', 'Data Ultima Modifica'),
            'indirizzo' => Yii::t('app', 'Indirizzo'),
            'socio_id' => Yii::t('app', 'Codice identificativo del socio collegato all\'account'),
            'repeat_password' => Yii::t('app', 'Ripeti la password'),
            'status' => Yii::t('app', 'Stato'),
            'reset_auth_key' => Yii::t('app', 'Reset Auth Key'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UtentiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UtentiQuery(get_called_class());
    }
}
