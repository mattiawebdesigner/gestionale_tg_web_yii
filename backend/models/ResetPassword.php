<?php
namespace backend\models;

use Yii;

class ResetPassword extends \yii\base\Model
{
    public $password;
    public $repeat_password;
    public $id;

    public function rules()
    {
        return [
            [['password', 'repeat_password'], 'required'],
            [['password', 'repeat_password'], 'string', 'max' => 255],
            ['repeat_password', 'compare', 'compareAttribute'=>'password', 'message' => Yii::t('app', 'Le password non coincidono')],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'password' => Yii::t('app', 'Password'),
            'repeat_password' => Yii::t('app', 'Ripeti Password'),
        ];
    }
}