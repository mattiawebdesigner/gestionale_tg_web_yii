<?php
namespace api\controllers\v1;
/* 
 * This Controller is used to connect REST api with desktop app (written in Java)
 */
use yii\rest\ActiveController;


class UtentiRestController extends ActiveController{
    // Specifica la classe del model associato
    public $modelClass = 'backend\models\Utenti';
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // Facoltativo: Aggiungi l'autenticazione se vuoi proteggere i dati degli utenti
        /*
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        */

        return $behaviors;
    }
}