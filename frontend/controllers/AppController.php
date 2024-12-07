<?php
/**
 * Controller per la gestione dei dati sull'applicazione
 * per Android e iOS
 */
namespace frontend\controllers;

use Yii;
use backend\models\Attivita;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * AttivitaController implements the CRUD actions for Attivita model.
 */
class AppController extends Controller
{
    private const API_KEY = "d9b7255c-e291-4465-aadc-adee213e6a12";
    
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Elenco delle attività in corso, non ancora passate
     * 
     * @return mixed
     */
    public function actionAttivita($api_key)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        if(self::API_KEY <> $api_key) return [];
        
        $model = Attivita::find()->where("data_attivita >= NOW()")->all();
        
        foreach($model as $v){
            $v->foto = "https://www.teatralmentegioia.it/crm/backend/web/".$v->foto;
        }
        
        return $model;
    }

    /**
     * Restituisce la singola attività
     * 
     * @return mixed
     */
    public function actionAttivitaSingle($id, $api_key)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        if(self::API_KEY <> $api_key) return [];
        
        $model = Attivita::find()->where(['id' => $id])->all();
        
        foreach($model as $v){
            $v->foto = "https://www.teatralmentegioia.it/crm/backend/web/".$v->foto;
            $v->data_attivita = date("d-m-Y H:i", strtotime($v->data_attivita));
            $v->costo = str_replace(".", ",", $v->costo);
        }
        
        return $model;
    }
}