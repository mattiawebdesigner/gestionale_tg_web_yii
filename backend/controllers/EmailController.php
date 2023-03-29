<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Email;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class EmailController extends Controller
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
                ],'access' => [
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

    public function actionIndex(){
        return $this->render('index');
    }
    public function actionCreate(){
        $model = new Email();
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
