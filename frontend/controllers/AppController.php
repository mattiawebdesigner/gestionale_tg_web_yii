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
use yii\helpers\Url;

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
    
    /**
     * Invia email di prenotazione
     * 
     * @param type $email
     * @param type $api_key
     * @return string|array
     */
    public function actionAttivitaPrenotazioneSendEmail($id, $email, $posti, $api_key){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        if(self::API_KEY <> $api_key) return [];
        
        $model          = Attivita::findOne($id);
        
        $events         = $model->nome;
        $date_time      = $model->data_attivita;
        $place          = $model->luogo;
        $reserved_seats = $posti;
        $image          = Yii::$app->params['backendWeb'].$model->foto;
        $base           = Url::to(['/attivita/prenotazioni', 'attivita_id' => $id, 'email' => $email], true);
        
        $res_email = Yii::$app->mailer->compose(['html' =>'layouts/html'], ['content' => <<<TESTO
<h1>
    <b>Teatralmente Gioia</b> <br />
    <img src="https://www.teatralmentegioia.it/crm/frontend/web/images/loghi/logo.png" style="max-width: 150px;max-height: 50px;" />
</h1>

<img src="{$image}" style="width: 150px" />
<h2>Prenotazione modificata con successo!</h2>
<h3>Evento: {$events}</h3>

<p><strong>Email di prenotazione</strong>: {$email}</p>max-
<p><strong>Data e orario di inizio</strong>: {$date_time}</p>
<p><strong>Luogo dell'evento</strong>: {$place}</p>
<p><strong>Posti prenotati</strong>: {$reserved_seats}</p>

<p>Per annullare la prenotazione puoi cliccare sul seguente link: <a href="{$base}">disdici</a> </p>

<p>Si consiglia di conservare questa email.</p>
TESTO])
->setFrom(["noreply@teatralmentegioia.it" => "Teatralmente Gioia"])
->setTo([Yii::$app->params['reservationEmail'], $email])
->setSubject(Yii::t('app', 'Modifica prenotazione, ').$events.' | '.Yii::$app->name)
->send();

        return $res_email;
        
    }
}