<?php

namespace backend\controllers;

use Yii;
use backend\models\Partecipazione;
use backend\models\PartecipazioneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PartecipazioneController implements the CRUD actions for Partecipazione model.
 */
class PartecipazioneController extends Controller
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
     * Lists all Partecipazione models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartecipazioneSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Partecipazione model.
     * @param string $attivita Attivita
     * @param string $nominativo Nominativo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($attivita, $nominativo)
    {
        return $this->render('view', [
            'model' => $this->findModel($attivita, $nominativo),
        ]);
    }

    /**
     * Creates a new Partecipazione model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Partecipazione();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'attivita' => $model->attivita, 'nominativo' => $model->nominativo]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Partecipazione model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $attivita Attivita
     * @param string $nominativo Nominativo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($attivita, $nominativo)
    {
        $model = $this->findModel($attivita, $nominativo);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'attivita' => $model->attivita, 'nominativo' => $model->nominativo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Partecipazione model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $attivita Attivita
     * @param string $nominativo Nominativo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($attivita, $nominativo)
    {
        $this->findModel($attivita, $nominativo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Partecipazione model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $attivita Attivita
     * @param string $nominativo Nominativo
     * @return Partecipazione the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($attivita, $nominativo)
    {
        if (($model = Partecipazione::findOne(['attivita' => $attivita, 'nominativo' => $nominativo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
