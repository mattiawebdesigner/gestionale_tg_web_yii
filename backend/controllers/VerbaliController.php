<?php

namespace backend\controllers;

use Yii;
use backend\models\TipoVerbali;
use backend\models\Verbali;
use backend\models\Convocazioni;
use backend\models\VerbaliSearch;
use backend\models\Allegati;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * VerbaliController implements the CRUD actions for Verbali model.
 */
class VerbaliController extends Controller
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
                            'actions' => [],//All page
                            'allow' => true,
                            'roles' => ['Super User', 'segreteria'],
                        ]
                    ],
                ]
            ],
            
        );
    }

    /**
     * Lists all Verbali models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VerbaliSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['data_inserimento' => SORT_DESC]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Convocazione model for owner.
     * 
     * @param int $numero_protocollo Numero Protocollo
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewSocioConvocazione($numero_protocollo){
        $delega = new \backend\models\Delega();
        $model = Convocazioni::findOne(['numero_protocollo' => $numero_protocollo]);
        
        //Registrazione delega ed invio email
        if(Yii::$app->request->isPost){
            if($delega->load(Yii::$app->request->post())){
                $delega->data_riunione = $model->data;
                $delega->delegante = Yii::$app->user->id;
                $delega->data_creazione = date('Y-m-d');
                $delega->convocazione_id = $model->numero_protocollo;
                
                if($delega->save()){                    
                    $delegante  = \backend\models\Utenti::find()->where(['id' => $delega->delegante])->one()->cognome.' '.\backend\models\Utenti::find()->where(['id' => $delega->delegante])->one()->nome;
                    $delegato   = \backend\models\Utenti::find()->where(['id' => $delega->delegante])->one()->cognome.' '.\backend\models\Utenti::find()->where(['id' => $delega->delegato])->one()->nome;
                    
                    //Generazione PDF
                    $heading = $this->renderPartial('_pdf-heading');
                    $content = $this->renderPartial('_iscrizioniPdf', [
                        'delegante' => $delegante,
                        'delegato'  => $delegato,
                        'delega'    => $delega,
                    ]);
                    $footer = $this->renderPartial('_pdf-footer');
                    
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
                    
                    $allegato_name = 'media_uploads' . DIRECTORY_SEPARATOR
                                                    . sha1(uniqid($model->numero_protocollo . "_" )). random_int(0, PHP_INT_MAX).".pdf";
                    $pdf = new Pdf([
                        'filename' => $allegato_name,
                        'marginTop' => '40',
                        'marginHeader' => '0',
                        'marginBottom' => '50',
                        // set to use core fonts only
                        'mode' => Pdf::MODE_CORE, 
                        // A4 paper format
                        'format' => Pdf::FORMAT_A4, 
                        // portrait orientation
                        'orientation' => Pdf::ORIENT_PORTRAIT, 
                        // stream to browser inline
                        'destination' => Pdf::DEST_FILE,
                        // your html content input
                        'content' => $content,  
                        // format content from your own css file if needed or use the
                        // enhanced bootstrap css built by Krajee for mPDF formatting 
                        'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                        // any css to be embedded if required
                        'cssInline' => $cssInline, 
                         // set mPDF properties on the fly
                        'options' => ['title' => Yii::t('app', 'Delega convocazione_' . $model->numero_protocollo),],
                         // call mPDF methods on the fly
                        'methods' => [ 
                            'SetHTMLHeader' => $heading,
                            'SetHTMLFooter' => $footer,
                        ]
                    ]);
                    // return the pdf output as per the destination setting
                    $pdf->render();
                    
                    //Invio email
                    $data_delega = date("d-m-Y", strtotime($delega->data_riunione));
                    Yii::$app->mailer->compose(['html' =>'layouts/html'], ['content' => <<<TESTO
                        Io sottoscritto <b>{$delegante}</b> delego <b>{$delegato}</b> per la riunione che si terrà in data <b>{$data_delega}</b>
TESTO])
                    ->setFrom([Yii::$app->params['noreplyEmail'] => Yii::$app->params['noreplyEmailName']])
                    ->setTo([Yii::$app->user->identity->email, Yii::$app->params['email']])
                    ->setSubject(Yii::t('app', 'Modulo di delega').' | '. Yii::t('app', 'Gestionale Teatralmente Gioia'))
                    ->attach($allegato_name)
                    ->send();
                        
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Delega inviata con successo'));
                    return $this->redirect(['view-socio-convocazione',  'numero_protocollo' => $numero_protocollo]);
                }
            }
        }
        
        return $this->render('viewSocioConvocazione', [
            'model' => $model,
            'delega' => $delega,
        ]);
    }

    /**
     * Displays a single Verbali model for owner.
     * 
     * @param int $numero_protocollo Numero Protocollo
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewSocioVerbale($numero_protocollo){
        $allegati = Allegati::find()->where(['id_verbale' => $numero_protocollo])->all();
        
        return $this->render('viewSocioVerbale', [
            'model' => $this->findModel($numero_protocollo),
            'allegati'  => $allegati,
        ]);
    }

    /**
     * Displays a single Verbali model.
     * @param int $numero_protocollo Numero Protocollo
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($numero_protocollo)
    {
        $allegati = Allegati::find()->where(['id_verbale' => $numero_protocollo])->all();
        
        return $this->render('view', [
            'model'     => $this->findModel($numero_protocollo),
            'allegati'  => $allegati,
        ]);
    }

    /**
     * Creates a new Verbali model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model      = new Verbali();
        $allegati   = new Allegati();
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                //Upload files
                $allegati->allegato = UploadedFile::getInstances($allegati, 'allegato');
                
                foreach ($allegati->allegato as $value) {
                    $allegati = new Allegati();
                    
                    $basePath = Yii::$app->basePath.'/web/allegati/';
                    $fileName = time().'-'.$value->baseName.".".$value->extension;
                    $allegati->allegato = 'allegati/'.$fileName;
                    $allegati->id_verbale = $model->numero_protocollo;
                    $allegati->nome_originale = $value->baseName;
                    $allegati->nome = $fileName;
                    
                    if($allegati->save()){
                        $value->saveAs($basePath.$fileName);
                    }else{
                        Yii::$app->session->setFlash("error", Yii::t('app', 'Errore nel caricare gli allegati del verbale'));
                    }
                }
                
                return $this->redirect(['view', 'numero_protocollo' => $model->numero_protocollo]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model'     => $model,
            'allegati'  => $allegati,
        ]);
    }
    
    /**
     * 
     * @param type $numero_protocollo
     * @return boolean
     */
    public function actionSave($numero_protocollo = "0"){
        
        if($numero_protocollo === "0"){
            //SAVE
            $model = new Verbali();
            $model->data_inserimento = $model->ultima_modifica = date("Y-m-d");
        }else{
            //UPDATE
            $model = $this->findModel($numero_protocollo);
        }
        
        if ($this->request->isPost) {
            $model->numero_protocollo = $this->request->post()['numero_protocollo'];
            $model->oggetto           = $this->request->post()['oggetto'];
            $model->ordine_del_giorno = $this->request->post()['ordine_del_giorno'];
            $model->data              = $this->request->post()['data'];
            $model->ora_inizio        = $this->request->post()['ora_inizio'];
            $model->ora_fine          = $this->request->post()['ora_fine'];
            $model->firma             = $this->request->post()['firma'];
            $model->tipo              = $this->request->post()['tipo'];
            $model->contenuto         = $this->request->post()['contenuto'];
            
            if($model->save()){
                return true;
            }
        }
        
        return false;
    }

    /**
     * Updates an existing Verbali model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $numero_protocollo Numero Protocollo
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($numero_protocollo)
    {
        $model      = $this->findModel($numero_protocollo);
        $allegati = new Allegati();
        //Allegati attuali del verbale
        $allegatiReal   = Allegati::find()->where(['id_verbale' => $numero_protocollo])->all();

        //Dati per la storicità delle modifiche
        $verbalePrimaDellaModifica = new \backend\models\VerbaleStorico();
        $verbalePrimaDellaModifica->bozza            = $model->bozza;
        $verbalePrimaDellaModifica->contenuto        = $model->contenuto;
        $verbalePrimaDellaModifica->data             = $model->data;
        $verbalePrimaDellaModifica->data_inserimento = $model->data_inserimento;
        $verbalePrimaDellaModifica->firma            = $model->firma;
        $verbalePrimaDellaModifica->numero_protocollo= $model->numero_protocollo;
        $verbalePrimaDellaModifica->oggetto          = $model->oggetto;
        $verbalePrimaDellaModifica->ora_fine         = $model->ora_fine;
        $verbalePrimaDellaModifica->ora_inizio       = $model->ora_inizio;
        $verbalePrimaDellaModifica->ordine_del_giorno= $model->ordine_del_giorno;
        $verbalePrimaDellaModifica->tipo             = $model->tipo;
        $verbalePrimaDellaModifica->save();
        
        $versioneVerbale = new \backend\models\VersioneVerbale();
        $versioneVerbale->numero_protocollo         = $model->numero_protocollo;
        $versioneVerbale->numero_protocollo_storico = $verbalePrimaDellaModifica->id;
        $versioneVerbale->data_modifica             = date("Y-m-d H:i:s");
        $versioneVerbale->utente                    = Yii::$app->user->identity->id;
        $versioneVerbale->save();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $allegati->allegato = UploadedFile::getInstances($allegati, 'allegato');
                
            foreach ($allegati->allegato as $value) {
                $allegati = new Allegati();

                $basePath = Yii::$app->basePath.'/web/allegati/';
                $fileName = time().'-'.$value->baseName.".".$value->extension;
                $allegati->allegato = 'allegati/'.$fileName;
                $allegati->id_verbale = $model->numero_protocollo;
                $allegati->nome_originale = $value->baseName;
                $allegati->nome = $fileName;
                
                if($allegati->save()){
                    $value->saveAs($basePath.$fileName);
                }else{
                    Yii::$app->session->setFlash("error", Yii::t('app', 'Errore nel caricare gli allegati del verbale'));
                }

            }
            return $this->redirect(['view', 'numero_protocollo' => $model->numero_protocollo]);
        }
        
        return $this->render('update', [
            'model' => $model,
            'allegati' => $allegati,
            'allegatiReal' => $allegatiReal,
        ]);
    }

    /**
     * Deletes an existing Verbali model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $numero_protocollo Numero Protocollo
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($numero_protocollo)
    {
        //Remove attachment
        $allegati = Allegati::find()->where(['id_verbale' => $numero_protocollo])->all();
        
        //delete file from filesystem
        foreach ($allegati as $val){
            unlink(Yii::$app->params['backendWebInternalPath'].$val->allegato);
        }
        
        $this->findModel($numero_protocollo)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Download generated file
     * 
     * @param int $numero_protocollo
     * @return kartik\mpdf\Pdf
     */
    public function actionDownload($numero_protocollo, $destination = Pdf::DEST_DOWNLOAD){
        $model = $this->findModel($numero_protocollo);
        
        $out = TipoVerbali::find()->joinWith('verbalis')
                          ->onCondition("tipo = id")
                         ->where(['tipo' => $numero_protocollo])
                         ->all();
        $allegati = Allegati::find()->where(['id_verbale' => $numero_protocollo])->all();
        
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
        $heading = $this->renderPartial('_pdf-heading');
        $content = $this->renderPartial('_pdf',[
            'model'     => $model,
            'out'       => $out,
            'allegati'  => $allegati,
        ]);
        $footer = $this->renderPartial('_pdf-footer');
        
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'filename' => "Prot.".$model->numero_protocollo." ".
                                    str_replace(" ", "", $model->oggetto)." ". 
                                    str_replace("/", "", $model->data).".pdf",
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
            'destination' => $destination, 
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
        
        foreach ($allegati as $allegato){
            
            if(end(explode(".", $allegato->allegato) ) === "pdf"){
                $pdf->addPdfAttachment(Yii::$app->params['backendWebInternalPath'].$allegato->allegato);
            }
        }
        
        // return the pdf output as per the destination setting
        return $pdf->render();
    }
    
    /**
     * Send email
     * 
     * @param int $numero_protocollo
     * @return type
     */
    public function actionSend($numero_protocollo) {
        $model                           = $this->findModel($numero_protocollo);
        $searchModel                     = new \backend\models\SociSearch();
        $partnerDataProvider             = $searchModel->search($this->request->queryParams);
        $partnerDataProvider->pagination = ['pageSize' => 20];
        
        if(Yii::$app->request->isPost){
            
            foreach ($this->request->post()['id'] as $val){
                $socio   = \backend\models\Soci::findOne(['id' => $val]);
                $oggetto = $model->oggetto;
                $pdf     = Yii::$app->params['sito'].\yii\helpers\Url::to(
                                    ['download', 
                                        'numero_protocollo' => $numero_protocollo,
                                        'destination' => Pdf::DEST_BROWSER]
                                    );
                
                Yii::$app->mailer->compose(['html' =>'layouts/html'], ['content' => <<<TESTO
<h2>$oggetto</h2>

Per scaricare il verbale puoi cliccare sul seguente link:
<a href="$pdf">$pdf</a>
                        
<p>Questa è un'email generata automaticamente, non rispondere</p>
TESTO])
                    ->setFrom(["noreply@teatralmentegioia.it" => "Teatralmente Gioia"])
                    ->setTo([$socio->email])
                    ->setSubject(Yii::t('app', 'Verbale assemblea').' | '. Yii::t('app', 'Gestionale Teatralmente Gioia'))
                    ->send();
            }
            Yii::$app->session->setFlash('success', Yii::t('app', 'Verbale inviato con successo'));
            
            return $this->redirect(['index']);
        }
        
        return $this->render('send', [
            'numero_protocollo'     => $numero_protocollo,
            'model'                 => $model,
            'partner'               => \backend\models\Soci::find()->all(),
            'searchModel'           => $searchModel,
            'partnerDataProvider'   => $partnerDataProvider,
        ]);
    }
    
    function actionManage() {
        return $this->render('manage');
    }
    
    /**
     * Get verbali results
     * 
     * @param int $anno
     * @return Verbali
     */
    public function actionContentVerbali($anno) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        return Verbali::find()->where("data LIKE '".$anno."%'")->andWhere(['bozza' => 1])->all();
    }
    
    /**
     * Get convocazioni results
     * 
     * @param int $anno
     * @return Verbali
     */
    public function actionContentConvocazioni($anno) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        return Convocazioni::find()->where("data LIKE '".$anno."%'")->andWhere(['bozza' => 1])->all();
    }
    
    /**
     * 
     */
    function actionIndexSocio(){
        return $this->render("index-socio", [
            'start' => 2004,
        ]);
    }
    
    /**
     * Visualizza le modifiche apportate ai verbali
     * indicando il socio che le ha apportate
     * 
     * Aggiunto in data 05/04/2023
     * 
     * @param string $numero_protocollo Numero di protocollo del verbale
     */
    function actionModifiche($numero_protocollo){
        $versioneVerbale = \backend\models\VersioneVerbale::find()
                        ->where(['numero_protocollo' => $numero_protocollo])
                        ->all();
        
        $modifiche = array();
        for($i = 0; $i<sizeof($versioneVerbale); $i ++){
            /*$verbaleStorico[$i] = \backend\models\VerbaleStorico::find()
                            ->where(['id' => $versioneVerbale[$i]->numero_protocollo_storico])
                            ->all();*/
            $modifiche[$i] = new \stdClass();
            
            //Dati sulla modifica del verbale
            $modifiche[$i]->verbaleStorico = \backend\models\VerbaleStorico::find()
                            ->where(['id' => $versioneVerbale[$i]->numero_protocollo_storico])
                            ->one();
            //Dati sulla versione del verbale
            $modifiche[$i]->versioneVerbale = new \stdClass();
            $modifiche[$i]->versioneVerbale->numero_protocollo = $numero_protocollo;
            $modifiche[$i]->versioneVerbale->numero_protocollo_storico = $versioneVerbale[$i]->numero_protocollo_storico;
            $modifiche[$i]->versioneVerbale->data_modifica = $versioneVerbale[$i]->data_modifica;
            $modifiche[$i]->versioneVerbale->utente = \backend\models\Utenti::findOne( $versioneVerbale[$i]->utente);
        }
        
        
        //$modifiche = $verbaleStorico;
        
        /*echo "<pre>";
        //print_r($versioneVerbale);
        print_r($modifiche);
        echo "</pre>";
        return;*/
        
        return $this->render("modifiche", [
            'numero_protocollo' => $numero_protocollo,
            'modifiche'         => $modifiche,
        ]);
    }
    
    /**
     * Finds the Verbali model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $numero_protocollo Numero Protocollo
     * @return Verbali the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($numero_protocollo)
    {
        if (($model = Verbali::findOne(['numero_protocollo' => $numero_protocollo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
