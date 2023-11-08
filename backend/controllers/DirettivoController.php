<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\Soci;
use kartik\mpdf\Pdf;

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
    
    public function actionPrint(){
        $model = \backend\models\ConsiglioDirettivo::find()->all();
        
        $cssInline = <<<CSS
            table{
                width: 100%;
            }
            th, h1{
                color: #F77736;
            }
            td, th{
                padding: 10px;
            }
            img{
                width: 50px;
            }
CSS;
        
        $heading = $this->renderPartial('pdf/_pdf-heading');
        $content = $this->renderPartial('pdf/print/_pdf',[
            'model'     => $model,
        ]);
        $footer = $this->renderPartial('pdf/_pdf-footer');
        
        $pdf = new Pdf([
            'filename' => "Elenco dei soci".date("dmY").".pdf",
            'marginLeft' => 10,
            'marginRight' => 10,
            'marginTop' => 50,
            'marginHeader' => 0,
            'marginBottom' => 50,
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            //'content' => $content,  
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => $cssInline, 
             // set mPDF properties on the fly
            'options' => [
                'title' => Yii::$app->name,
            ],
             // call mPDF methods on the fly
            'methods' => [
                //'SetHeader' => [Yii::$app->name.' - '.Yii::t('app', 'Verbale')], 
                'SetHTMLHeader' => $heading,
                //'SetFooter' => ['Data di generazione: '.date('d-m-Y H:i:s').' • Pagina: {PAGENO}'],
                'SetHTMLFooter' => $footer,
            ]
        ]);
        return $pdf->render();
    }
}
