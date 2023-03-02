<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Nominativo;
use frontend\models\NominativoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\debug\models\timeline\DataProvider;
use backend\models\Attivita;
use yii\data\ActiveDataProvider;

/**
 * NominativoController implements the CRUD actions for Nominativo model.
 */
class NominativoController extends Controller
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
     * Lists all Nominativo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "albo_oro";
        
        $searchModel = new NominativoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAttivita($id){
        
        $this->layout = "albo_oro";
        
        return $this->render('attivita', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Attivita::find()->innerJoin("partecipazione", "partecipazione.attivita = attivita.id")
                                           ->innerJoin("nominativo", "nominativo.id = partecipazione.nominativo")
                                           ->where(['nominativo.id' => $id]),
                'pagination' => [
                    'pageSize' => 15,
                ],
            ]),
            'nominativo' => \backend\models\Nominativo::findOne(['id' => $id]),
        ]);
    }
    
    /**
     * Displays a single Nominativo model.
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
     * Finds the Nominativo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return Nominativo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nominativo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
