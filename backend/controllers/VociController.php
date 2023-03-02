<?php

namespace backend\controllers;

use backend\models\Voci;
use backend\models\VociSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * VociController implements the CRUD actions for Voci model.
 */
class VociController extends Controller
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
     * Lists all Voci models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VociSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Voci model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Voci model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id)
    {
        $model = array();
        
        if ($this->request->isPost) {            
            if($this->request->post("Voci", "[]") !== "[]"){
                $count = count($this->request->post("Voci", "[]")['voce']);
                    
                for($i = 0; $i<$count; $i ++){
                    $rendicontoVoci = new \backend\models\RendicontoVoci();

                    $post = $this->request->post("Voci", "[]");
                    $model[$i] = new Voci();
                    $model[$i]->voce = $post['voce'][$i];
                    $model[$i]->data_contabile = $post['data_contabile'][$i];
                    $model[$i]->prezzo = $post['prezzo'][$i];
                    $model[$i]->tipologia = $post['tipologia'][$i];
                    
                    if($model[$i]->save()){
                        
                        $rendicontoVoci->id_rendiconto = $id;
                        $rendicontoVoci->id_voce       = $model[$i]->id;

                        $rendicontoVoci->save();

                    }
                }

                return $this->redirect(['/voci/create', 'id' => $id]);
            }
        }
        
        $model = new Voci();
        $model->loadDefaultValues();
        
        $in = Voci::find() ->joinWith('rendicontoVocis')
                          ->onCondition("id_voce = id")
                         ->where(['tipologia' => 'entrata', 'id_rendiconto' => $id])
                          ->orderBy(['data_contabile' => SORT_ASC])
                         ->all();


        $out = Voci::find()->joinWith('rendicontoVocis')
                          ->onCondition("id_voce = id")
                         ->where(['tipologia' => 'uscita', 'id_rendiconto' => $id])
                          ->orderBy(['data_contabile' => SORT_ASC])
                         ->all();

        return $this->render('create', [
            'rendiconto' => \backend\models\Rendiconto::findOne($id),
            'model' => $model,
            'in'    => $in,
            'out'   => $out,
        ]);
    }

    /**
     * Updates an existing Voci model. This request is get via ajax.
     * 
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $voce, $prezzo, $data_contabile, $tipologia)
    {
        
        $model                  = $this->findModel($id);
        $model->voce            = $voce;
        $model->prezzo          = $prezzo;
        $model->data_contabile  = $data_contabile;
        $model->tipologia       = $tipologia;
        
        $model->save();
    }

    /**
     * Deletes an existing Voci model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
    }

    /**
     * Finds the Voci model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Voci the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Voci::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
