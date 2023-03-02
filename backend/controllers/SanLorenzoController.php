<?php

namespace backend\controllers;

use Yii;


use yii\web\Controller;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * AllegatiController implements the CRUD actions for Allegati model.
 */
class SanLorenzoController extends Controller
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
                            'roles' => ['Super User', 'San Lorenzo'],
                        ],
                    ],
                ],
            ]
        );
    }
    
    /**
     * 
     * @param type $action
     * @return boolean
     */
    public function beforeAction($action) {
        if(parent::beforeAction($action)){
            //$this->layout = "sanlorenzo";
            return true;
        }
        
        return false;
    }
    
    /**
     * Return index page for San Lorenzo administrator
     * 
     * @return mixed
     */
    public function actionIndex(){
        return $this->render('index');
    }
    
}
