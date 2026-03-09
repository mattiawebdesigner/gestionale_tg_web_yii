<?php
namespace api\models\v1;

use common\models\LoginForm;

class ApiLoginForm extends LoginForm 
{
    // Sovrascrivi solo il metodo login per non usare le sessioni di PHP
    public function login()
    {
        if ($this->validate()) {
            // Non chiamiamo Yii::$app->user->login($this->getUser())
            // perché non vogliamo avviare una sessione PHP/Cookie.
            // Ci limitiamo a confermare che l'utente è valido.
            return true; 
        }
        return false;
    }
    
    public function getUser()
    {
        return parent::getUser();
    }
}