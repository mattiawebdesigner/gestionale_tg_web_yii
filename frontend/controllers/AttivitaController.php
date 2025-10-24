<?php

namespace frontend\controllers;

use Yii;
use backend\models\Attivita;
use backend\models\AttivitaSearch;
use backend\models\Prenotazioni;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * AttivitaController implements the CRUD actions for Attivita model.
 */
class AttivitaController extends Controller
{
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
     * Lists all Attivita models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AttivitaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * 
     * @param int $attivita_id
     * @param string $email
     * @return string
     */
    public function actionPrenotazioni($attivita_id, $email)
    {   
        $prenotazioni = new Prenotazioni();   
        if ($this->request->isPost) {
            if ($prenotazioni->load($this->request->post())) {
                $prenotazioni->attivita_id = $attivita_id;
                
                $this->deleteItem($attivita_id, $email);
                if($prenotazioni->save()){
                    
                    $model = $this->findModel($attivita_id);
                    
                    $events = $model->nome;
                    $date_time = $model->data_attivita;
                    $place = $model->luogo;
                    $reserved_seats = $prenotazioni->prenotazioni;
                    $email = $prenotazioni->email;
                    $image = Yii::$app->params['backendWeb'].$model->foto;
                    $base = Url::to(['/attivita/prenotazioni', 'attivita_id' => $attivita_id, 'email' => $email], true);
                
                    Yii::$app->mailer->compose(['html' =>'layouts/html'], ['content' => <<<TESTO
<h1>
    <b>Teatralmente Gioia</b> <br />
    <img src="https://www.teatralmentegioia.it/crm/frontend/web/images/loghi/logo.png" style="width: 150px" />
</h1>

<img src="{$image}" style="width: 150px" />
<h2>Prenotazione modificata con successo!</h2>
<h3>Evento: {$events}</h3>

<p><strong>Email di prenotazione</strong>: {$email}</p>
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
                    
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Prenotazione modificata con successo, riceverai un email di conferma'));
                    
                    return $this->redirect(['prenotazioni', 'attivita_id' => $prenotazioni->attivita_id, 'email' => $prenotazioni->email]);
                }else{
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Si � verificato un errore nella modifica della prenotazione, riprova pi� tardi o contatta un\'amministratore'));
                }
            }
        }
        $prenotazioni = Prenotazioni::find()->where(["attivita_id" => $attivita_id, "email" => $email])->all();
        
        if(!isset($prenotazioni[0])){
            return $this->render('prenotazioni', [
                'prenotazioni' => null,
                'attivita' => null,
            ]);
        }
        
        $attivita = Attivita::find()->where(['id' => $prenotazioni[0]->attivita_id])->all();
        
        return $this->render('prenotazioni', [
            'prenotazioni' => $prenotazioni[0],
            'attivita' => $attivita[0],
            'posti_occupati' => Prenotazioni::find()->where(["attivita_id" => $attivita_id])->sum("prenotazioni"),
        ]);
    }

    /**
     * Displays a single Attivita model.
     * @param string $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionInfo($id)
    {
        $model = $this->findModel($id);
        $prenotazioni = new Prenotazioni();
        
        //Search
        if($this->request->post("action") == "search"){           
            $prenotazioni->load($this->request->post());
            
            return $this->redirect(['prenotazioni',
                'attivita_id' => $id,
                'email' => $prenotazioni->email, 
            ]);
        }
        
        if($prenotazioni->load($this->request->post())){
            $prenotazioni->attivita_id = $id;
            
            $tmp = Prenotazioni::find()->where(["attivita_id" => $id, "email" => $prenotazioni->email])->count();
            
            if($tmp == 0){
                if ($prenotazioni->save()) {
                    $events = $model->nome;
                    $date_time = $model->data_attivita;
                    $place = $model->luogo;
                    $reserved_seats = $prenotazioni->prenotazioni;
                    $email = $prenotazioni->email;
                    $image = Yii::$app->params['backendWeb'].$model->foto;
                    $base = Url::to(['/attivita/prenotazioni', 'attivita_id' => $id, 'email' => $email], true);
                    
                    Yii::$app->mailer->compose('layouts/html', ['content' => <<<TESTO
<h1>
    <b>Teatralmente Gioia</b> <br />
    <img src="https://www.teatralmentegioia.it/crm/frontend/web/images/loghi/logo.png" style="width: 150px" />
</h1>
                        
<h2>Prenotazione effettuata!</h2>
<h3>Evento: {$events}</h3>

<img src="{$image}" style="width: 150px" />

<p><strong>Email di prenotazione</strong>: {$email}</p>
<p><strong>Data e orario di inizio</strong>: {$date_time}</p>
<p><strong>Luogo dell'evento</strong>: {$place}</p>
<p><strong>Posti prenotati</strong>: {$reserved_seats}</p>

<p>Per annullare la prenotazione puoi cliccare sul seguente link: <a href="{$base}">disdici</a> </p>

<p>Si consiglia di conservare questa email.</p>
TESTO])
->setFrom(["noreply@teatralmentegioia.it" => "Teatralmente Gioia"])
->setTo([Yii::$app->params['reservationEmail'], $email])
->setSubject(Yii::t('app', 'Prenotazione, ').$events.' | '.Yii::$app->name)
->send();
                    
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Prenotazione effettuata con successo, riceverai un email di conferma'));
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Si &egrave; verificato un problema nel salvare la prenotazione'));
                }
                
                
                return $this->redirect(['info', 
                    'model' => $model,
                    'prenotazioni' => new Prenotazioni(),
                    'id' => $id,
                ]);
            }
            
            Yii::$app->session->setFlash('error', Yii::t('app', 'Risulta gi&agrave; una prenotazione per l\'email {email}', [
                'email' => $prenotazioni->email,
            ]));
        }
        
        return $this->render('info', [
            'model' => $model,
            'prenotazioni' => $prenotazioni,
            'posti_occupati' => Prenotazioni::find()->where(["attivita_id" => $id])->sum("prenotazioni"),
        ]);
    }
    
    /**
     * 
     * 
     * @return string
     */
    public function actionNext($offset = 0, $_this = 0){
        $nPerPagina = 20;
        
        $attivita = Attivita::find()->where("data_attivita >= NOW()")->limit($nPerPagina)->offset($offset)->all();
        $totaleAttivita = Attivita::find()->where("data_attivita >= NOW()")->count();
        $page = ceil($totaleAttivita/$nPerPagina);
        
        return $this->render('next', [
            'attivita' => $attivita,
            'page' => $page,
            'nPerPagina' => $nPerPagina,
            '_this' => $_this,
            'tot' => $totaleAttivita,
        ]);
    }

    /**
     * Deletes an existing Attivita model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $email)
    {
        $this->deleteItem($id, $email);
        
        $model = $this->findModel($id);
        
        $events = $model->nome;
        $email = $email;
        $image = Yii::$app->params['backendWeb'].$model->foto;
        
        Yii::$app->mailer->compose('layouts/html', ['content' => <<<TESTO
<h1>
    <b>Teatralmente Gioia</b> <br />
    <img src="https://www.teatralmentegioia.it/crm/frontend/web/images/loghi/logo.png" style="width: 150px" />
</h1>

<img src="{$image}" style="width: 150px" />

<h2>Prenotazione eliminata con successo!</h2>
<h3>Evento: {$events}</h3>

<p><strong>Email di prenotazione</strong>: {$email}</p>

TESTO])
->setFrom(["noreply@teatralmentegioia.it" => "Teatralmente Gioia"])
->setTo([Yii::$app->params['reservationEmail'], $email])
->setSubject(Yii::t('app', 'Eliminazione prenotazione, ').$events.' | '.Yii::$app->name)
->send();

Yii::$app->session->setFlash('success', Yii::t('app', 'Prenotazione eliminata con successo, riceverai un email di conferma'));

        
        return $this->redirect(['next']);
        
    }

    private function deleteItem($id, $email){
        (Prenotazioni::find()->where(['attivita_id' => $id, 'email' => $email])->all())[0]->delete();
    }
    
    /**
     * Finds the Attivita model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return Attivita the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attivita::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
