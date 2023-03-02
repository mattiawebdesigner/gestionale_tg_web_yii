<?php

namespace frontend\controllers;

use backend\models\Gallery;
use backend\models\GallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
    public function actionIndex()
    {
        $model = Gallery::find()
                        ->joinWith("galleryFotos as gf")
                        ->joinWith("fotos")
                        ->all();
        
        return $this->render('index', [
            'model' => $model,
        ]);
    }
    
    public function actionAlbum($album_id) {
        $model = Gallery::find()
                        ->joinWith("galleryFotos as gf")
                        ->joinWith("fotos")
                        ->where(['gallery.id' => $album_id])
                        ->all();
        
        return $this->render('album', [
            'model' => $model,
        ]);
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
}
