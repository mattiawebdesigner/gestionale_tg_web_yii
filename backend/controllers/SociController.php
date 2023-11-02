<?php

namespace backend\controllers;

use Yii;
use backend\models\Soci;
use backend\models\SociSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\AnnoSociale;
use backend\models\SocioAnnoSociale;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

/**
 * SociController implements the CRUD actions for Soci model.
 */
class SociController extends Controller
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
                            'roles' => ['Super User', 'segreteria'],
                        ],
                        /*[
                            'actions' => ['select'],
                            'allow' => true,
                            'roles' => ['Super User', 'segretaria'],
                        ],*/
                        [//all
                            'actions' => ['index-socio'],
                            'allow' => true,
                            'roles' => ['Socio'],
                        ],
                        [
                            'actions' => ['index-socio-app'],
                            'allow' => true,
                        ]
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Soci models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new SociSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $annoSociale  = $model = \backend\models\AnnoSociale::find()->orderBy(['anno' => SORT_DESC])->all();

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'annoSociale'  => $annoSociale,
        ]);
    }

    /**
     * Displays a single Soci model.
     * @param string $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $anno = 0)
    {
        $socio = $this->findModel($id);
        $firma = \backend\models\Firma::find()->where(['socio' => $id])->one();
        $years = \backend\models\SocioAnnoSociale::find()->where(['socio' => $id])->all();
        
        return $this->render('view', [
            'model' => $socio,
            'years' => $years,
            'anno'  => $anno,
            'firma' => $firma??false,
        ]);
    }

    /**
     * Creates a new Soci model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($anno = 0)
    {
        $model              = new Soci();
        $annoSociale        = new AnnoSociale();
        $socio_anno_sociale = new SocioAnnoSociale();
        $firma              = new \backend\models\Firma();
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                
                if($anno === 0) {return $this->redirect(['view', 'id' => $model->id]);}
                
                
                //Redirect for add socio on an year
                return $this->redirect(['/anno-sociale/add', 'socio' => $model->id, 'anno' => $anno, 'action' => 'user']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model'             => $model,
            'annoSociale'       => $annoSociale,
            'socioAnnoSociale'  => $socio_anno_sociale,
            'firma'             => $firma,
        ]);
    }
    
    /**
     * Updates an existing Soci model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $anno)
    {
        $model = $this->findModel($id);
        $annoSociale    = new AnnoSociale();
        
        $socio_anno_sociale = SocioAnnoSociale::find()->where(['socio' => $id])
                                                      ->andWhere(['anno' => $anno])
                                                      ->one();
        $firma = \backend\models\Firma::find()->where(['socio' => $id])->one();
        if(is_null($firma)){
            $firma = new \backend\models\Firma();
        }
        
        if ($this->request->isPost && $firma->load($this->request->post())) {
            $firmaUpload = UploadedFile::getInstance($firma, 'firma');
            
            if(!is_null($firmaUpload)){
                //Dati per l'upload della firma
                $basePath = Yii::$app->params['firmaUploadPath'];
                $fileName = time()."_". sha1($firmaUpload->baseName).".".$firmaUpload->extension;
                $firma->firma = Yii::$app->params['firmaUploadFolder'].$fileName;
                $firma->socio = $id;

                if($firma->save()){
                    $firmaUpload->saveAs($basePath.$fileName);

                    return $this->redirect(['view', 'id' => $model->id, "anno" => $anno,]);
                }
            }
        }
        
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $socio_anno_sociale->load($this->request->post()) && $socio_anno_sociale->save();
            
            return $this->redirect(['view', 'id' => $model->id, "anno" => $anno,]);
        }
        
        return $this->render('update', [
            'model'                 => $model,
            'annoSociale'           => $annoSociale,
            'anno'                  => $anno,
            'socioAnnoSociale'      => $socio_anno_sociale,
            //Validità del socio 
            //(quota pagata => si, no altrimenti)
            'validita'              => $socio_anno_sociale->validita,
            //Firma del socio di cui si stanno visualizzando i dati
            'firma'                 => $firma??false,
        ]);
    }

    /**
     * Deletes an existing Soci model.
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
     * Visualizza l'elenco dei soci per poterlo stampare
     */
    public function actionPrintShow(){
        $searchModel = new SociSearch();
        $dataProvider = $searchModel->searchWithRelationship($this->request->queryParams);
        
        return $this->render('print', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Stampa il pdf
     */
    public function actionPrint(){
        $model = Soci::sociAttivi();
        
        $cssInline = <<<CSS
            table{
                width: 100%;
            }
            th, h1{
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
        $content = $this->renderPartial('pdf/print/_pdf',[
            'model'     => $model,
        ]);
        $footer = $this->renderPartial('_pdf-footer');
        
        $pdf = new Pdf([
            'filename' => "Elenco dei soci".date("dmY").".pdf",
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
            'destination' => Pdf::DEST_BROWSER, 
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
     * Select a partner for create an user with login
     */
    public function actionSelect(){
        $searchModel = new SociSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        
        return $this->render('select', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Show all partner
     * 
     * @return type
     */
    public function actionIndexSocio() {
        $searchModel = new SociSearch();
        $dataProvider = $searchModel->searchWithRelationship($this->request->queryParams);
        
        $searchModelSupporter  = new SociSearch();
        $dataProviderSupporter = $searchModel->searchWithRelationshipSupporter($this->request->queryParams);

        return $this->render('index-socio', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            
            'searchModelSupporter'  => $searchModelSupporter,
            'dataProviderSupporter' => $dataProviderSupporter,
        ]);
        
    }
    
    /**
     * Show all partner
     * 
     * @return type
     */
    /*public function actionMagazzinoSocio() {
        
        $searchModel = new \backend\models\ProdottoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('magazzino-socio', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }*/
    
    public function actionGetSociAnno($anno){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        return Soci::find()->joinWith("socioAnnoSociales")->where(['anno' => $anno])->orderBy(['cognome' => SORT_ASC])->all();
    }
    
    
    /**
     * Show all
     * 
     * @return mixed
     */
    public function actionAll(){
        $searchModel = new SociSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        
        return $this->render('all', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Show all partner
     * 
     * @return type
     */
    public function actionIndexSocioApp() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $model = Soci::find()->joinWith('annos')
                    ->where(['anno_sociale.anno' => date('Y')])
                    ->andWhere(['sostenitore' => 'no'])
                    ->andWhere(['validita' => 'si'])
                    ->orderBy(["cognome" => SORT_ASC, "nome" => SORT_ASC])
                    ->all();
        
        return $model;
        
    }
    
    /**
     * Finds the Soci model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return Soci the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Soci::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
