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
class DirettivoController extends Controller
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
        $model = \backend\models\ConsiglioDirettivo::find()->all();
        
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
