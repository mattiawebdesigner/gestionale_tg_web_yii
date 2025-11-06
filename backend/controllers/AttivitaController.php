<?php
namespace backend\controllers;

use Yii;
use backend\models\Attivita;
use backend\models\AttivitaSearch;
use backend\models\Prenotazioni;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Media;
use backend\models\MediaUploadForm;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

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
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['login', 'error'],
                            'allow' => true,
                        ],
                        [
                            'actions' => [],//All page
                            'allow' => true,
                            'roles' => ['Super User', 'event manager'],
                        ],
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
     * Displays a single Attivita model.
     * @param string $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    /**
     * Creates a new Attivita model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Attivita();
        $media = Media::find()->all();
        if ($this->request->isPost) {
            $model->load($this->request->post());
            
            //Compile field "parametri"
            $data_attivita = $model->data_attivita;
            $parametri = [];
            foreach ($data_attivita as $data){
                $parametri['dates']['days'][] = [
                    'date'  => date("Y-m-d H:i", strtotime($data)),
                    'price' => $model->costo,
                    'place' => $model->posti_disponibili
                ];
            }
            $model->parametri = json_encode($parametri);
                        
            //Solo per compatibilità rispetto ai vecchi dati inseriti e agli obblighi
            //derivanti dal campo della tabella
            $model->data_attivita = date("Y-m-d H:i", strtotime($model->data_attivita[0]));
            
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        
        $upload = new MediaUploadForm();
        
        return $this->render('create', [
            'model'     => $model,
            'media'     => $media,
            'upload'    => $upload,
        ]);
    }
    
    /**
     * Updates an existing Attivita model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        $media = Media::find()->all();
        $upload = new MediaUploadForm();
        
        return $this->render('update', [
            'model' => $model,
            'media'     => $media,
            'upload'    => $upload,
        ]);
    }
    
    /**
     * Upload media
     *
     * @return \yii\web\Response
     */
    public function actionUpload()
    {
        $model = new MediaUploadForm();
        $mediaFile=null;
        if (Yii::$app->request->isPost) {
            $model->mediaFile = UploadedFile::getInstance($model, 'mediaFile');
            if ($mediaFile = $model->upload()) {
                
            }
        }
        
        $media = new Media();
        $media->link = $mediaFile['uploadDirectory'].$mediaFile['fileName'].".".$mediaFile['extension'];
        $media->nome = $mediaFile['fileName'];
        $media->mime = $mediaFile['type'];
        $media->save();
        
        $model = new Attivita();
        $upload = new MediaUploadForm();
        $media = Media::find()->all();
        
        return $this->response->redirect(['/attivita/create',
            'model'     => $model,
            'media'     => $media,
            'upload'    => $upload,
        ]);
    }
    
    /**
     * Show all events with reservation.
     * 
     * @return mixed
     */
    public function actionReservations(){
        $model = Attivita::find()->where(['prenotazione' => 'yes'])->all();
        $searchModel = new AttivitaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        
        return $this->render('reservations', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
    
    /**
     * Show reservations of selected event
     * 
     * @param int $id
     * @return mixed
     */
    public function actionReservation($id){
        $model = $this->findModel($id);
        $reservations = \backend\models\Prenotazioni::find()
                            ->where(['attivita_id' => $id])
                            ->orderBy(['cognome' => SORT_ASC, 'nome' => SORT_ASC])
                            ->asArray()
                            ->all();
        
        $group_reservations = [];
        foreach($reservations as $k => $book){
            $turn = json_decode($model->parametri)->dates->days[$book['turno']-1];
            $group_reservations[$book['turno']][$turn->date."|".$turn->price.'|'.$turn->place][] = [
                'id'            => $book['id'],
                'prenotazioni'  => $book['prenotazioni'],
                'email'         => $book['email'],
                'attivita_id'   => $book['attivita_id'],
                'turno'         => $book['turno'],
                'nome'          => $book['nome'],
                'cognome'       => $book['cognome'],
                'data'          => $turn->date, 
                'price'         => $turn->price, 
                'place'         => $turn->place, 
            ];
        }
        ksort($group_reservations);
        
        
        /*$dataProvider = new ActiveDataProvider([
            'query' => $reservations,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);*/
        
        /*echo "<pre>";
        print_r($group_reservations); 
        echo "</pre>";
        return;*/
        
        return $this->render('reservation', [
            'model'         => $model,
            'reservations'  => $group_reservations,
            'attivita_id'   => $id,
            //'dataProvider' => $dataProvider,
            //'placesLeft' => $this->getPlacesLeft($id),
        ]);
    }
    
    /**
     * 
     * @param type $id
     * @return mixed
     */
    public function actionReservationUpdate($attivita_id, $email) {
        $model = $this->findPrenotazioniModel($attivita_id, $email);
        
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            //Send email
            $attivita = $this->findModel($attivita_id);
            $events = $attivita->nome;
            $date_time = $attivita->data_attivita;
            $place = $attivita->luogo;
            $reserved_seats = $model->prenotazioni;
            //$base = \yii\helpers\Url::to(['/attivita/prenotazioni', 'attivita_id' => $attivita_id, 'email' => $email], true);
            $base = Yii::$app->params['frontendUrl'].'?r=attivita/prenotazioni&attivita_id='.$attivita_id.'&email='.$model->email;
            
            Yii::$app->mailer->compose(['html' =>'layouts/html'], ['content' => <<<TESTO
<h2>Prenotazione modificata con successo!</h2>
<h3>Evento: {$events}</h3>


<p><strong>Email di prenotazione</strong>: {$model->email}</p>
<p><strong>Data e orario di inizio</strong>: {$date_time}</p>
<p><strong>Luogo dell'evento</strong>: {$place}</p>
<p><strong>Posti prenotati</strong>: {$reserved_seats}</p>

<p>Per annullare la prenotazione puoi cliccare sul seguente link: <a href="{$base}">disdici</a> </p>

<p>Si consiglia di conservare questa email.</p>

TESTO])
->setFrom([Yii::$app->params['senderEmail'] => "Teatralmente Gioia"])
->setTo([Yii::$app->params['reservationEmail'], $model->email])
->setSubject(Yii::t('app', 'Modifica prenotazione, ').' | '.Yii::$app->name)
->send();
            
            return $this->redirect(['reservation', 'id' => $model->attivita_id]);
        }
        
        return $this->render('reservationUpdate', [
            'model'      => $model,
            //'placesLeft' => $this->getPlacesLeft($attivita_id),
        ]);
        
    }
    
    /**
     * Delete a reservation
     * 
     * @param type $attivita_id
     * @param type $email
     * @return type
     */
    public function actionReservationDelete($attivita_id, $email) {
        $this->findPrenotazioniModel($attivita_id, $email)->delete();
        
        $attivita = $this->findModel($attivita_id);
        $events = $attivita->nome;
        $date_time = $attivita->data_attivita;
        $place = $attivita->luogo;
        $base = Yii::$app->params['frontendUrl'].'?r=attivita/info&id='.$attivita_id;

        Yii::$app->mailer->compose(['html' =>'layouts/html'], ['content' => <<<TESTO
<h2>Prenotazione cancellata con successo!</h2>
<h3>Evento: {$events}</h3>


<p><strong>Email di prenotazione</strong>: {$email}</p>
<p><strong>Data e orario di inizio</strong>: {$date_time}</p>
<p><strong>Luogo dell'evento</strong>: {$place}</p>

<p>Se vuoi effettuare una nuova prenotazione puoi cliccare sul seguente link: <a href="{$base}">vedi evento</a> </p>

<p>Si consiglia di conservare questa email.</p>

TESTO])
->setFrom([Yii::$app->params['senderEmail'] => "Teatralmente Gioia"])
->setTo([Yii::$app->params['reservationEmail'], $email])
->setSubject(Yii::t('app', 'Modifica prenotazione, ').' | '.Yii::$app->name)
->send();
        
        return $this->redirect(['reservation', 'id' => $attivita_id]);
    }
    
    
    /**
     * Deletes an existing Attivita model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        return $this->redirect(['index']);
    }
    
    /**
     * generates the PDF for a specific shift
     * 
     * @param type $attivita_id Reservation ID
     * @param type $turn Turn 
     */
    public function actionPdf($attivita_id, $turn){
        $attivita       = $this->findModel($attivita_id);
        $prenotazioni   = $this->findPrenotazioneByAttivitaIDAndTurn($attivita_id, $turn);
        
        $heading = $this->renderPartial('pdf/_pdf-heading');
        $content = $this->renderPartial('pdf/_pdf', [
            'attivita'      => $attivita,
            'prenotazioni'  => $prenotazioni,
            'turn'          => $turn
        ]);
        $footer = $this->renderPartial('pdf/_pdf-footer');
        
        $cssInline = <<<CSS
            table{
                width: 100%;
            }
            th{
                color: #F77736;
            }
            td, th{
                padding: 10px;
            }
            img{
                width: 50px;
            }
CSS;
        
        $pdf = new Pdf([
            'filename' => str_replace(" ", "_", $attivita->nome)."_".$turn."_".date("YmdHis").".pdf",
            'marginLeft' => 10,
            'marginRight' => 10,
            'marginTop' => 50,
            'marginHeader' => 0,
            'marginBottom' => 50,
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_DOWNLOAD, 
            // your html content input
            //'content' => $content,  
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => $cssInline, 
             // set mPDF properties on the fly
            'options' => [
                'title' => Yii::$app->name,
            ],
             // call mPDF methods on the fly
            'methods' => [
                //'SetHeader' => [Yii::$app->name.' - '.Yii::t('app', 'Verbale')], 
                'SetHTMLHeader' => $heading,
                //'SetFooter' => ['Data di generazione: '.date('d-m-Y H:i:s').' • Pagina: {PAGENO}'],
                'SetHTMLFooter' => $footer,
            ]
        ]);
        
        return $pdf->render();
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
    
    /**
     * Finds the Attivita model based on its primary key value.
     * If the model is not found, a 404 HTTML exception will be thrown.
     * @param string $attivita_id Attività ID
     * @param string $email
     * @return Prenotazioni the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPrenotazioniModel($attivita_id, $email){
        if( ($model = Prenotazioni::find()->where(['attivita_id' => $attivita_id, 'email' => $email])->one()) ){
            return $model;
        }
        
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    /**
     * 
     * @param type $id
     * @param type $turn
     * @return type
     * @throws NotFoundHttpException
     */
    protected function findPrenotazioneByAttivitaIDAndTurn($id, $turn){
        if( ($model = Prenotazioni::find()->where(['attivita_id' => $id, "turno" => $turn])->orderBy(['cognome' => SORT_ASC, 'nome' => SORT_ASC])->all()) ){
            return $model;
        }
        
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
}
