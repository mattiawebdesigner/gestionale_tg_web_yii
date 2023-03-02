<?php

namespace backend\controllers;

use Yii;
use backend\models\Gallery;
use backend\models\GallerySearch;
use backend\models\GalleryFoto;
use backend\models\Foto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends Controller
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
     * Lists all Gallery models.
     *
     * @return string
     */
    public function actionIndex($l="main")
    {
        $this->layout = "sanlorenzo";
        
        $searchModel = new GallerySearch();
        switch ($l){
            case "sanlorenzo": $dataProvider = $searchModel->search2($this->request->queryParams);break;
            default: $dataProvider = $searchModel->search($this->request->queryParams);;
        }
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'l' => $l,
        ]);
    }
    
    /**
     * View, Create and Update slide
     * 
     * @param int $id Gallery id
     * @return type
     */
    public function actionView($id){
        $gallery = $this->findModel($id);
        $galleryFoto = GalleryFoto::find()->where(['gallery_id' => $id])->all();
        
        //Foto presenti per la gallery
        $foto = [];
        foreach ($galleryFoto as $val){
            $f = Foto::find()->where(['id' => $val->foto_id])->one();
            if( !empty($f) ) $foto[] = $f;
        }
        //-------------------------------
        
        //Controllo se è stato inviato un form per l'upload delle foto della galleria
        //In questo caso aggiorno oppure salvo le foto e aggiorno la gallery, se necessario
        if( $this->request->isPost ){
            $foto_post = [];
            $tot = $this->request->post("Foto", "[]")==null ? count($this->request->post("Foto", "[]")['id']) : 0;
            
            //Creo nuovi slide in base agli upload
            $fotoUpload = new Foto();
            $upload = UploadedFile::getInstances($fotoUpload, 'url');
            if(isset($upload) && count($upload) > 0){
                foreach($upload as $k => $u){
                    $basePath = Yii::$app->basePath.'/web/galleria_media/';
                    $fileName = time().'-'. md5($u->baseName).".".$u->extension;
                    
                    $u->saveAs($basePath.$fileName);//Save images
                    
                    $fotoUpload->url = "galleria_media/" . $fileName;
                    $fotoUpload->open = "no";
                    $fotoUpload->posizione = 1;
                    
                    $fotoUpload->save();
                    
                    $galleryFoto = new GalleryFoto();
                    $galleryFoto->foto_id    = $fotoUpload->id;
                    $galleryFoto->gallery_id = $id;
                    $galleryFoto->save();
                    
                    $fotoUpload = new Foto();
                }
                
                return $this->redirect(['view',
                    'id' => $id,
                ]);
            }
            //-------------------------------------------------------------
            
            //Upload slide
            if($this->request->isPost){
                $tot = count($this->request->post("Foto", "[]")['id']);

                for($i=0; $i<$tot; $i ++){
                    //Load models
                    $fotoModels[$i] = new Foto();
                    
                    foreach ($this->request->post("Foto") as $key => $f){
                        $fotoModels[$i]->$key = $this->request->post("Foto", "[]")[$key][$i];
                        if($key == "id"){
                            $fotoModels[$i]->url = Foto::findOne(['id' => $this->request->post("Foto", "[]")[$key][$i]])->url;
                            
                            //Cancello i valori per reinserirli dopo
                            if($this->findModelFoto($this->request->post("Foto", "[]")[$key][$i]) <> null){
                                $this->findModelFoto($this->request->post("Foto", "[]")[$key][$i])->delete();
                            }
                            
                            //$fotoModels = $this->findModelFoto( $this->request->post("Foto", "[]")[$key][$i] );
                        }
                    }
                    //----------------
                    
                    //Salvo i record modificati
                    $fotoModels[$i]->save();
                            
                    $galleryFoto = new GalleryFoto();
                    $galleryFoto->foto_id    = $fotoModels[$i]->id;
                    $galleryFoto->gallery_id = $id;
                    $galleryFoto->save();
                    //------------------------------------------------
                }
            }
            //-------------------------------------------------------------
            
            //Aggiorno la gallery
            if($gallery->load($this->request->post())){
                $gallery->save();
            }
            //--------------------------
            
            return $this->redirect(['view',
                'id' => $id,
            ]);
        }
        //-- Fine upload o save foto -------------
        
        return $this->render('view', [
            'gallery'         => $gallery,
            'galleryFoto'   => $galleryFoto,
            'foto'          => $foto,
            /*
             * Usato per le foto da inserire
             */
            'fotoNew'       => new Foto(),
        ]);
    }

    /**
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($l="main")
    {
        $this->layout = $l;
        
        $gallery = new Gallery();
        
        //Save the gallery for the appropriate site
        //if don't find site, save gallery for main site
        switch ($l){
            case "sanlorenzo": $gallery->sito_di_riferimento = Gallery::SITE_SAN_LORENZO;break;
            default: $gallery->sito_di_riferimento = Gallery::SITE_MAIN;break;
        }

        if ($this->request->isPost) {
            if ($gallery->load($this->request->post()) && $gallery->save()) {
                //$tot = count($this->request->post("Foto", "[]")['id']);
                $fotoUpload = new Foto();
                $upload = UploadedFile::getInstances($fotoUpload, 'url');
                if(isset($upload) && count($upload) > 0){
                    foreach($upload as $k => $u){
                        $basePath = Yii::$app->basePath.'/web/galleria_media/';
                        $fileName = time().'-'. md5($u->baseName).".".$u->extension;

                        $u->saveAs($basePath.$fileName);//Save images

                        $fotoUpload->url = "galleria_media/" . $fileName;
                        $fotoUpload->open = "no";
                        $fotoUpload->posizione = 1;

                        $fotoUpload->save();

                        $galleryFoto = new GalleryFoto();
                        $galleryFoto->foto_id    = $fotoUpload->id;
                        $galleryFoto->gallery_id = $gallery->id;
                        $galleryFoto->save();
                        
                        $fotoUpload = new Foto();//New object of foto
                    }
                }
                
                return $this->redirect(['view', 'id' => $gallery->id]);
            }
        } else {
            $gallery->loadDefaultValues();
        }
        
        return $this->render('create', [
            'model' => $gallery,
            
            'gallery'         => $gallery,
            'galleryFoto'   => GalleryFoto::find()->where(['gallery_id' => $gallery->id])->all(),
            'foto'          => null,
            /*
             * Usato per le foto da inserire
             */
            'fotoNew'       => new Foto(),
        ]);
    }

    /**
     * Updates an existing Gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Gallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Deletes an existing Gallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteSlide($id, $gallery_id)
    {
        $this->findModelFoto($id)->delete();

        return $this->redirect(['view', 'id' => $gallery_id]);
    }

    /**
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the Foto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelFoto($id)
    {
        if (($model = Foto::findOne(['id' => $id])) !== null) {
            return $model;
        }

        return null;
    }

    /**
     * Finds the Foto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Gallery ID
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelGalleryFoto($id)
    {
        if (($model = GalleryFoto::findOne(['gallery_id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
