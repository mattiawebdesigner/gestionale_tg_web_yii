<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Da\QrCode\QrCode;
use \yii\web\UploadedFile;

/**
 * AllegatiController implements the CRUD actions for Allegati model.
 */
class QrController extends Controller
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
    
    public function actionIndex(){
        $model = new \backend\models\QR();
        
        if($this->request->isPost) {
            $model->logo = UploadedFile::getInstance($model, 'logo');
            $model->logo->saveAs(Yii::$app->params['image_upload_path'] . $model->logo->baseName . '.' . $model->logo->extension);
            
                echo "<pre>";
                print_r(Yii::$app->params['crm_image_upload_path'] . $model->logo->baseName . '.' . $model->logo->extension);
                print_r($model->logo);
                echo "</pre>";
            
            return;
        }
        
        /*$format = new \Da\QrCode\Format\BookMarkFormat(['title' => 'https://open.spotify.com/track/34RMBYAfVXRfSpZBUOu63S?si=DzO9LsbXTD-V6tFw1VSR0w', 'url' => '']);
        $qrCode = (new QrCode("https://open.spotify.com/track/34RMBYAfVXRfSpZBUOu63S?si=DzO9LsbXTD-V6tFw1VSR0w"))
                ->setSize(250)
                ->setMargin(5);
                //->setLogo(__DIR__.'/../web/WeekArt/weekArt-logo.png');
                //->setBackgroundColor(51, 153, 255);

        // now we can display the qrcode in many ways
        // saving the result to a file:

        $qrCode->writeFile(__DIR__ . '/code.png'); // writer defaults to PNG when none is specified
        */
        

        // display directly to the browser 
        /*header('Content-Type: '.$qrCode->getContentType());
        echo $qrCode->writeString();*/
        
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}