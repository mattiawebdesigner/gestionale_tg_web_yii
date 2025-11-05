<?php

namespace frontend\controllers;

use Yii;
use backend\models\Attivita;
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
    /*public function actionIndex()
    {
        $searchModel = new AttivitaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/
    
    /**
     * 
     * @param int $attivita_id
     * @param string $email
     * @return string
     */
    public function actionPrenotazioni($attivita_id, $email, $turn=0)
    {   
        $prenotazioni = new Prenotazioni();
        //Corregge il valore del turno per il suo corretto utilizzo
        //Se si tratta del primo turno la differenza $turn-2 darebbe -1 e non è valido,
        //quindi correggo riportando il suo valore a 1.
        //Se si tratta dei turni dal 2 in poi (registrati nel campo JSON parametri
        //sul database) allora effettuo il calcolo della diferrenza $turn-2
        $turnCorrect = (($turn-2)<0)?1:$turn-2;
        
        if ($this->request->isPost) {
            if ($prenotazioni->load($this->request->post())) {
                $prenotazioni->attivita_id = $attivita_id;
                
                $this->deleteItem($attivita_id, $email, $turn);
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
->setFrom([Yii::$app->params['senderEmail']=> Yii::$app->params['senderName']])
->setTo([Yii::$app->params['reservationEmail'], $email])
->setSubject(Yii::t('app', 'Modifica prenotazione, ').$events.' | '.Yii::$app->name)
->send();
                    
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Prenotazione modificata con successo, riceverai un email di conferma'));
                    
                    return $this->redirect(['prenotazioni', 'attivita_id' => $prenotazioni->attivita_id, 'email' => $prenotazioni->email]);
                }else{
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Si &grave; verificato un errore nella modifica della prenotazione, riprova pi&ugrave; tardi o contatta un\'amministratore'));
                }
            }
        }
        $prenotazioni = Prenotazioni::find()->where(["attivita_id" => $attivita_id, "email" => $email, 'turno' => $turn])->all();
        
        if(!isset($prenotazioni) || sizeof($prenotazioni) === 0){
            return $this->render('prenotazioni', [
                'prenotazioni'  => null,
                'attivita'      => Attivita::find()->where(['id' => $attivita_id])->one(),
                'turno'         => $turn,
                'turnCorrect'       => $turnCorrect,
            ]);
        }
        
        $attivita               = Attivita::find()->where(['id' => $prenotazioni[0]->attivita_id])->one();
        $attivita->parametri    = json_decode($attivita->parametri);
        
        return $this->render('prenotazioni', [
            'prenotazioni'      => $prenotazioni[0],
            'attivita'          => $attivita,
            'posti_occupati'    => Prenotazioni::find()->where(["attivita_id" => $attivita_id])->sum("prenotazioni"),
            'turno'             => $turn,
            'turnCorrect'       => $turnCorrect,
            
        ]);
    }

    /**
     * Displays a single Attivita model.
     * @param string $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionInfo($id, $turn = 0)
    {
        
        $model = $this->findModel($id);
        $prenotazioni = new Prenotazioni();
        //Corregge il valore del turno per il suo corretto utilizzo
        //per ottenere la posizione del turno nel JSON.
        $turnCorrect = $turn==0?0:$turn-1;
        
        $model->parametri = json_decode($model->parametri);
        
        //Search
        if($this->request->post("action") == "search"){
            $prenotazioni->load($this->request->post());
            
            return $this->redirect(['prenotazioni',
                'attivita_id' => $id,
                'email' => $prenotazioni->email,
                'turn'  => $turn,
            ]);
        }
        
        if($prenotazioni->load($this->request->post())){
            $prenotazioni->attivita_id = $id;
            
            $tmp = Prenotazioni::find()->where(["attivita_id" => $id, "email" => $prenotazioni->email, 'turno' => $prenotazioni->turno])->count();
            
            if($tmp == 0){
                $model->parametri = json_decode($model->parametri);
                if ($prenotazioni->save()) {
                    $events         = $model->nome;
                    $date_time      = date("d-m-Y H:i", strtotime($model->parametri->dates->days[$turnCorrect]->date));
                    $price          = $model->parametri->dates->days[$turnCorrect]->price;
                    $place          = $model->luogo;
                    $reserved_seats = $prenotazioni->prenotazioni;
                    $email          = $prenotazioni->email;
                    $image          = Yii::$app->params['backendWeb'].$model->foto;
                    $base           = Url::to(['/attivita/prenotazioni', 'attivita_id' => $id, 'email' => $email], true);
                    
                    Yii::$app->mailer->compose('@common/mail/layouts/html', ['content' => <<<TESTO
<h1>
    <b>Teatralmente Gioia</b> <br />
    <img src="https://www.teatralmentegioia.it/crm/frontend/web/images/loghi/logo.png" style="width: 150px" />
</h1>
                        
<h2>Prenotazione effettuata!</h2>
<h3>Evento: {$events}</h3>

<img src="{$image}" style="width: 150px" />

<p><strong>Email di prenotazione</strong>: {$email}</p>
<p><strong>Costo</strong>: {$price}</p>
<p><strong>Data e orario di inizio</strong>: {$date_time}</p>
<p><strong>Luogo dell'evento</strong>: {$place}</p>
<p><strong>Posti prenotati</strong>: {$reserved_seats}</p>

<p>Per annullare la prenotazione puoi cliccare sul seguente link: <a href="{$base}">disdici</a> </p>

<p>Si consiglia di conservare questa email.</p>
TESTO])
->setFrom(["iloveteatro@teatralmentegioia.it" => "Teatralmente Gioia"])
->setTo([Yii::$app->params['reservationEmail'], $email])
->setSubject(Yii::t('app', 'Prenotazione, ').$events.' | '.Yii::$app->name)
->send();
                    
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Prenotazione effettuata con successo, riceverai un email di conferma'));
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', 'Si &egrave; verificato un problema nel salvare la prenotazione'));
                }
                
                return $this->redirect(['info',
                    'model'         => $model,
                    'prenotazioni'  => new Prenotazioni(),
                    'id'            => $id,
                    'turn'          => $turn
                ]);
            }
            
            Yii::$app->session->setFlash('error', Yii::t('app', 'Risulta gi&agrave; una prenotazione per l\'email {email}', [
                'email' => $prenotazioni->email,
            ]));
        }
        
        return $this->render('info', [
            'model'             => $model,
            'prenotazioni'      => $prenotazioni,
            'posti_occupati'    => Prenotazioni::find()->where(["attivita_id" => $id, 'turno' => $turn])->sum("prenotazioni")??0,
            'turnCorrect'       => $turnCorrect,
            'turn'              => $turn
        ]);
    }
    
    /**
     * 
     * 
     * @return string
     */
    public function actionNext($offset = 0, $_this = 0){
        $nPerPagina = 20;
        
        $attivita       = Attivita::find()->where("data_attivita >= NOW()")->limit($nPerPagina)->offset($offset)->all();
        $totaleAttivita = Attivita::find()->where("data_attivita >= NOW()")->count();
        $page           = ceil($totaleAttivita/$nPerPagina);
        
        
        return $this->render('next', [
            'attivita'      => $attivita,
            'page'          => $page,
            'nPerPagina'    => $nPerPagina,
            '_this'         => $_this,
            'tot'           => $totaleAttivita,
        ]);
    }

    /**
     * Deletes an existing Attivita model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @param string $email Email of reservation
     * @param int $turn Number of turn
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $email, $turn)
    {
        $this->deleteItem($id, $email, $turn);
        
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
->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
->setTo([Yii::$app->params['reservationEmail'], $email])
->setSubject(Yii::t('app', 'Eliminazione prenotazione, ').$events.' | '.Yii::$app->name)
->send();

Yii::$app->session->setFlash('success', Yii::t('app', 'Prenotazione eliminata con successo, riceverai un email di conferma'));

        
        return $this->redirect(['next']);
        
    }

    /**
     * Delete a reservation by email and number of turn
     * 
     * @param type $id
     * @param type $email
     * @param type $turn
     */
    private function deleteItem($id, $email, $turn){
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
