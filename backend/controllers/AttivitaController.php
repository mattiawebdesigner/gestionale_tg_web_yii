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
use yii\data\ActiveDataProvider;

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
            if ($model->load($this->request->post()) && $model->save()) {
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
        $reservations = \backend\models\Prenotazioni::find()->where(['attivita_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $reservations,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        return $this->render('reservation', [
            'model' => $model,
            'reservations' => $reservations,
            'dataProvider' => $dataProvider,
            'placesLeft' => $this->getPlacesLeft($id),
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
            'placesLeft' => $this->getPlacesLeft($attivita_id),
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
     * @return integer
     */
    private function getPlacesLeft($id){
        $model = $this->findModel($id);
        return $model->posti_disponibili-Prenotazioni::find()->where(['attivita_id' => $id])->sum('prenotazioni');
    }
}
