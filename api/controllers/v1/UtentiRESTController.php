<?php
/* 
 * This Controller is used to connect REST api with desktop app (written in Java)
 */
use yii\rest\ActiveController;


class UtentiRESTController extends ActiveController{
    // Specifica la classe del model associato
    public $modelClass = 'backend\models\Utenti';
    
    
}