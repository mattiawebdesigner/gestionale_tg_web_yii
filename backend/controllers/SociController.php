<?php

namespace backend\controllers;

use Yii;
use backend\models\Soci;
use backend\models\SociSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use backend\models\AnnoSociale;
use backend\models\SocioAnnoSociale;
use backend\models\Attivita;
use backend\models\AttivitaSearch;
use backend\models\Nominativo;

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
    public function actionView($id, $anno)
    {
        $socio = $this->findModel($id);
        $years = \backend\models\SocioAnnoSociale::find()->where(['socio' => $id])->all();
        
        return $this->render('view', [
            'model' => $socio,
            'years' => $years,
            'anno'  => $anno,
        ]);
    }

    /**
     * Creates a new Soci model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($anno = 0)
    {
        $model          = new Soci();
        $annoSociale    = new AnnoSociale();
        $socio_anno_sociale = new SocioAnnoSociale();
        
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
        /*echo "<pre>";
        print_r($socio_anno_sociale->load($this->request->post()));
        print_r($socio_anno_sociale);
        echo "</pre>";
        die;*/
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $socio_anno_sociale->load($this->request->post()) && $socio_anno_sociale->save();
            
            return $this->redirect(['view', 'id' => $model->id, "anno" => $anno,]);
        }

        return $this->render('update', [
            'model'         => $model,
            'annoSociale'   => $annoSociale,
            'socioAnnoSociale'   => new SocioAnnoSociale(),
            /**
             * Validità del socio 
             * (quota pagata => si, no altrimenti)
             */
            'validita'      => $socio_anno_sociale->validita,
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
