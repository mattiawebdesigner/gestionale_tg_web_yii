<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
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
                            'roles' => ['Super User', 'Socio'],
                        ],
                    ],
                ],
            ]
        );
    }
    
    public function actionIndex(){
        ini_set("memory_limit","512M");
        
        $model = new \backend\models\QR();
        
        if($this->request->isPost) {
            if($model->load($this->request->post())){
                if(isset($this->request->post('QR')['logo'])){
                    $model->logo = UploadedFile::getInstance($model, 'logo');
                    $filename = md5($model->logo->baseName).md5(date('YmdHmi')). '.' . $model->logo->extension;
                    $model->logo->saveAs(Yii::$app->params['crm_qr_logo_upload_path'].$filename);

                    //Genero il QR Code testuale con logo
                    $qrCode = (new QrCode($model->testo))
                                ->setSize(600)
                                ->setMargin(5)
                                ->setBackgroundColor(255, 255, 255)
                                ->setLogo(Yii::$app->params['crm_qr_logo_upload_path'].$filename)
                                ->setLogoWidth(96)
                                ->setScaleLogoHeight(false)
                                ;
                }else{
                    //Genero il QR Code testuale con logo
                    $qrCode = (new QrCode($model->testo))
                                ->setSize(600)
                                ->setMargin(5)
                                ->setBackgroundColor(255, 255, 255)
                                ;
                }
                $qrImageLink = Yii::$app->params['crm_qr_generate_path']."qr_". md5(date('Ydm')).".png";
                $qrCode->writeFile($qrImageLink);
                
                
                return $this->redirect(['qr/generato', 'qrCode' => $qrImageLink]);
            }
        }
        
        return $this->render('index', [
            'model' => $model,
        ]);
    }
    
    public function actionGenerato($qrCode){
        return $this->render('generato', [
            'qrCode' => $qrCode,
        ]);
    }
}