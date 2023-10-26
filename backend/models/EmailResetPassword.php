<?php
namespace backend\models;

use Yii;

class EmailResetPassword extends \yii\base\Model
{
    public $email;

    public function rules()
    {
        return [
            [['email', 'repeat_password'], 'required'],
            [['email'], 'string', 'max' => 150],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
        ];
    }
}