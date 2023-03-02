<?php

namespace backend\controllers;

use backend\models\Anno;
//use backend\models\AnnoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AnnoController implements the CRUD actions for Anno model.
 */
class AnnoController extends Controller
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
     * Lists all Anno models.
     *
     * @return string
     */
    /*public function actionIndex()
    {
        $searchModel = new AnnoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Displays a single Anno model.
     * @param string $anno Anno
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionView($anno)
    {
        return $this->render('view', [
            'model' => $this->findModel($anno),
        ]);
    }*/

    /**
     * Creates a new Anno model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Anno();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['/rendiconto/index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Anno model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $anno Anno
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionUpdate($anno)
    {
        $model = $this->findModel($anno);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'anno' => $model->anno]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }*/

    /**
     * Deletes an existing Anno model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $anno Anno
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($anno)
    {
        $this->findModel($anno)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Anno model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $anno Anno
     * @return Anno the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($anno)
    {
        if (($model = Anno::findOne(['anno' => $anno])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
