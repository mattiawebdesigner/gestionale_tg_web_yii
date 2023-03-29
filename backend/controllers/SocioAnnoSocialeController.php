<?php

namespace backend\controllers;

use Yii;
use backend\models\SocioAnnoSociale;
use backend\models\SocioAnnoSocialeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SocioAnnoSocialeController implements the CRUD actions for SocioAnnoSociale model.
 */
class SocioAnnoSocialeController extends Controller
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
     * Lists all SocioAnnoSociale models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SocioAnnoSocialeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SocioAnnoSociale model.
     * @param string $socio Socio
     * @param string $anno Anno
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($socio, $anno)
    {
        return $this->render('view', [
            'model' => $this->findModel($socio, $anno),
        ]);
    }

    /**
     * Creates a new SocioAnnoSociale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SocioAnnoSociale();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'socio' => $model->socio, 'anno' => $model->anno]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SocioAnnoSociale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $socio Socio
     * @param string $anno Anno
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($socio, $anno)
    {
        $model = $this->findModel($socio, $anno);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'socio' => $model->socio, 'anno' => $model->anno]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SocioAnnoSociale model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $socio Socio
     * @param string $anno Anno
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($socio, $anno)
    {
        $this->findModel($socio, $anno)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SocioAnnoSociale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $socio Socio
     * @param string $anno Anno
     * @return SocioAnnoSociale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($socio, $anno)
    {
        if (($model = SocioAnnoSociale::findOne(['socio' => $socio, 'anno' => $anno])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
