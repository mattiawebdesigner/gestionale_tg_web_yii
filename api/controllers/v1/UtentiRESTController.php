<?php
namespace api\controllers\v1;
/* 
 * This Controller is used to connect REST api with desktop app (written in Java)
 */

use Yii;
use yii\web\Response;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use api\models\v1\ApiLoginForm;

class UtentiRestController extends ActiveController{
    // Specifica la classe del model associato
    public $modelClass = 'backend\models\Utenti';
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        
        //Autenticazione se vuoi proteggere i dati degli utenti
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'except' => ['login'], 
        ];

        return $behaviors;
    }
    
    public function actionLogin()
    {
        $model = new ApiLoginForm();

        // Carica i dati POST (username e password) inviati da Java
        if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
            $user = $model->getUser();

            if ($user && $user->validatePassword($model->password)) {
                $user->generateAccessToken();
                if ($user->save(false)) { // Salviamo il token nel DB
                    return [
                        'status'        => 'success',
                        'access_token'  => $user->access_token,
                        'name'          => $user->nome,
                        'surname'       => $user->cognome,
                        'id'            => $user->id
                    ];
                }
            }
        }

        Yii::$app->response->statusCode = 401;
        return [
            'status' => 'error',
            'message' => 'Credenziali non valide o errore salvataggio token',
        ];
    }
}