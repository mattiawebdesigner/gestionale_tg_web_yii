<?php

namespace backend\controllers;

use backend\models\IntestazioneSocial;
use backend\models\IntestazioneSocialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IntestazioneSocialController implements the CRUD actions for IntestazioneSocial model.
 */
class IntestazioneSocialController extends Controller
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
     * Lists all IntestazioneSocial models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new IntestazioneSocialSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IntestazioneSocial model.
     * @param int $id_intestazione Id Intestazione
     * @param int $id_social Id Social
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_intestazione, $id_social)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_intestazione, $id_social),
        ]);
    }

    /**
     * Creates a new IntestazioneSocial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new IntestazioneSocial();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_intestazione' => $model->id_intestazione, 'id_social' => $model->id_social]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing IntestazioneSocial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_intestazione Id Intestazione
     * @param int $id_social Id Social
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_intestazione, $id_social)
    {
        $model = $this->findModel($id_intestazione, $id_social);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_intestazione' => $model->id_intestazione, 'id_social' => $model->id_social]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing IntestazioneSocial model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_intestazione Id Intestazione
     * @param int $id_social Id Social
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_intestazione, $id_social)
    {
        $this->findModel($id_intestazione, $id_social)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the IntestazioneSocial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_intestazione Id Intestazione
     * @param int $id_social Id Social
     * @return IntestazioneSocial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_intestazione, $id_social)
    {
        if (($model = IntestazioneSocial::findOne(['id_intestazione' => $id_intestazione, 'id_social' => $id_social])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
