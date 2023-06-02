<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;
use backend\models\Votazione;
use backend\models\VotazioneSearch;

/**
 * VerbaliController implements the CRUD actions for Verbali model.
 */
class VotazioneController extends Controller
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
                            'roles' => ['Socio', 'Super User'],
                        ],
                        [
                            'actions' => ['index-socio-app', 'view-socio-app'],
                            'allow' => true,
                        ]
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Votazioni models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VotazioneSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Elenco delle votazione (per i soci).
     *
     * @return string
     */
    public function actionIndexSocio()
    {
        $searchModel = new VotazioneSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index-socio', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Pagina di gestione delle votazioni
     * 
     * @return
     */    
    public function actionGestioneVotazioni(){
        return $this->render("gestione-votazioni");
    }
    
    /**
     * Esporta l'elenco dei diritti al voto
     */
    public function actionDownloadElencoSociVoto($id){
        /**
         * Elenco dei soci in regola
         */
        $soci = $this->getSociConDirittoDiVoto($id);
        
       $out = "OUT";
        
        $cssInline = <<<CSS
            table{
                width: 100%;
            }
            table, td{
                border: 0px solid #E04926;
                border-collapse: collapse;
            }
            th{
                color: #F77736;
            }
            td, th{
                padding: 10px;
            }
            img{
                width: 50px;
            }
CSS;
        
        $heading = $this->renderPartial('_pdf-heading');
        $content = $this->renderPartial('_pdf_soci_diritto_voto',[
            'soci' => $soci,
        ]);
        $footer = $this->renderPartial('_pdf-footer');
        
        
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'filename' => "elenco_soci_elezioni_".time().".pdf",
            'marginLeft' => 5,
            'marginRight' => 5,
            'marginTop' => 50,
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
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@backend/web/css/pdf-style.css',
            // any css to be embedded if required
            'cssInline' => $cssInline, 
             // set mPDF properties on the fly
            'options' => [
                'title' => Yii::$app->name,
            ],
             // call mPDF methods on the fly
            'methods' => [
                'SetHTMLHeader' => $heading,
                'SetHTMLFooter' => $footer,
            ]
        ]);
        // return the pdf output as per the destination setting
        return $pdf->render();
    }
    
    /**
     * Indici una nuova votazione
     * 
     * @return type
     */
    public function actionCreate()
    {
        $votazione = new Votazione();
        
        if ($this->request->isPost) {
            
            $votazione->load($this->request->post());
            $votazione->info = json_encode($this->request->post("Votazione", "[]")['info']);
            
            if($votazione->save()){
                return $this->redirect(['update', 'id' => $votazione->id]);
            }
        }

        return $this->render('create',[
            'votazione' => $votazione,
        ]);
    }
    
    
    /**
     * Aggiorna una nuova votazione
     * 
     * @return void
     */
    public function actionUpdate($id)
    {
        $votazione = $this->findVotazioneModel($id);
        
        if ($this->request->isPost) {
            
            $votazione->load($this->request->post());
            $votazione->info = json_encode($this->request->post("Votazione", "[]")['info']);
            
            if($votazione->save()){
                return $this->redirect(['update', 'id' => $votazione->id]);
            }
        }
        
        return $this->render('update',[
            'votazione' => $votazione,
        ]);
    }
    
    /**
     * Scarica elenco Soci
     */
    public function actionDownloadScheda($id){
        $votazione = $this->findVotazioneModel($id);
        /**
         * Elenco dei soci in regola
         */
        $soci = $this->getSociConDirittoDiVoto($id);
        
        $cssInline = <<<CSS
            table{
                width: 100%;
            }
            table, td{
                border: 0px solid #E04926;
                border-collapse: collapse;
            }
            th{
                color: #F77736;
            }
            td, th{
                padding: 10px;
            }
            img{
                width: 50px;
            }
CSS;
        
        $heading = $this->renderPartial('_pdf-heading');
        $content = $this->renderPartial('_pdf_scheda',[
            'soci'      => $soci,
            'votazione' => $votazione,
        ]);
        $footer = $this->renderPartial('_pdf-footer');
        
        
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'filename' => "scheda_elettorale".time().".pdf",
            'marginLeft' => 5,
            'marginRight' => 5,
            'marginTop' => 50,
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
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@backend/web/css/pdf-style.css',
            // any css to be embedded if required
            'cssInline' => $cssInline, 
             // set mPDF properties on the fly
            'options' => [
                'title' => Yii::$app->name,
            ],
             // call mPDF methods on the fly
            'methods' => [
                'SetHTMLHeader' => $heading,
                'SetHTMLFooter' => $footer,
            ]
        ]);
        // return the pdf output as per the destination setting
        return $pdf->render();
    }
    
    /**
     * Aggiorna una nuova votazione
     * 
     * @return void
     */
    public function actionView($id)
    {
        $votazione          = $this->findVotazioneModel($id);
        $soci               = $this->getSociConDirittoDiVoto($id);
        $votazione_has_voti = $soci = (new \yii\db\Query())
                            ->select("*, COUNT(*) tot_voti")
                            ->from('{{%votazione_has_voti}} vhv')
                            ->innerJoin('{{%voti}} v', 'vhv.id_voto = v.id')
                            ->innerJoin('{{%soci}} s', 's.id = v.id_socio')
                            ->where(['vhv.id_votazione' => $id])
                            ->groupBy('v.id_socio')
                            ->all();
        $rosa_eletti    = $soci = (new \yii\db\Query())
                            ->select("*, COUNT(*) tot_voti")
                            ->from('{{%votazione_has_voti}} vhv')
                            ->innerJoin('{{%voti}} v', 'vhv.id_voto = v.id')
                            ->innerJoin('{{%soci}} s', 's.id = v.id_socio')
                            ->where(['vhv.id_votazione' => $id])
                            ->groupBy('v.id_socio')
                            ->orderBy("tot_voti DESC")
                            ->limit(5)
                            ->all();
        
        return $this->render('view',[
            'votazione'             => $votazione,
            'soci'                  => $soci,
            'votazione_has_voti'    => $votazione_has_voti,
            'rosa_eletti'           => $rosa_eletti,
        ]);
    }
    
    
    /**
     * Aggiorna una nuova votazione
     * 
     * @return void
     */
    public function actionViewSocio($id){
        
        $votazione          = $this->findVotazioneModel($id);
        $soci               = $this->getSociConDirittoDiVoto($id);
        $votazione_has_voti = $soci = (new \yii\db\Query())
                            ->select("*, COUNT(*) tot_voti")
                            ->from('{{%votazione_has_voti}} vhv')
                            ->innerJoin('{{%voti}} v', 'vhv.id_voto = v.id')
                            ->innerJoin('{{%soci}} s', 's.id = v.id_socio')
                            ->where(['vhv.id_votazione' => $id])
                            ->groupBy('v.id_socio')
                            ->all();
        $rosa_eletti    = $soci = (new \yii\db\Query())
                            ->select("*, COUNT(*) tot_voti")
                            ->from('{{%votazione_has_voti}} vhv')
                            ->innerJoin('{{%voti}} v', 'vhv.id_voto = v.id')
                            ->innerJoin('{{%soci}} s', 's.id = v.id_socio')
                            ->where(['vhv.id_votazione' => $id])
                            ->groupBy('v.id_socio')
                            ->orderBy("tot_voti DESC")
                            ->limit(5)
                            ->all();
        
        return $this->render('view-socio',[
            'votazione'             => $votazione,
            'soci'                  => $soci,
            'votazione_has_voti'    => $votazione_has_voti,
            'rosa_eletti'           => $rosa_eletti,
        ]);
    }
    
    /**
     * Aggiungi un voto alla votazione
     * 
     * @param int $id Id della votazione
     */
    public function actionAddVoto($id){
        $votazione      = $this->findVotazioneModel($id);
        $soci           = $this->getSociConDirittoDiVoto($id);
        $voto           = new \backend\models\Voti();
        
        if($this->request->isPost){
            
            $voti_post = $this->request->post()['Voti'];
            foreach ($voti_post['n_scheda'] as $k => $n_scheda){
                if(is_null($n_scheda) || empty($n_scheda) || $n_scheda == ""){continue;}
                
                $voto           = new \backend\models\Voti();
                $voto->id_socio = $voti_post['id_socio'][$k];
                $voto->n_scheda = sprintf("%05d", $n_scheda);
                $voto->save();
                
                $votazione_has_voti = new \backend\models\VotazioneHasVoti();
                $votazione_has_voti->id_votazione   = $id;
                $votazione_has_voti->id_voto        = $voto->id;
                $votazione_has_voti->save();
            }
            
            return $this->redirect(['add-voto', 'id' => $id]);
        }
        
        return $this->render('add-voto',[
            'votazione'     => $votazione,
            'soci'          => $soci,
            'voto'          => $voto,
        ]);
    }
    
    /**
     * Restituisce tutti i soci con diritto di voto
     * 
     * @return
     */
    public function getSociConDirittoDiVoto($id){
        return $soci = (new \yii\db\Query())
                ->select("{{%socio_anno_sociale}}.*, {{%soci}}.*")
                ->from('{{%socio_anno_sociale}}')
                ->innerJoin('{{%soci}}', '{{%soci}}.id = {{%socio_anno_sociale}}.socio')
                ->where(["anno" => (new \yii\db\Query())->select('anno')->from('{{%votazione}}')->where(['id' => $id])->one()])
                ->andWhere(["validita" => 'si'])
                ->andWhere(['>', 'DATEDIFF(NOW(), soci.data_di_nascita)' , 365*18])//calcolo se sono maggiorenni
                ->orderBy(['cognome' => 'ASC', 'nome' => 'ASC'])
                ->all();
    }
    
    //APP
    

    /**
     * Usato per l'APP Android e iOS.
     * 
     * Elenco delle votazione (per i soci).
     *
     * @return string
     */
    public function actionIndexSocioApp()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        return Votazione::find()->orderBy(['anno' => SORT_DESC])->all();
    }
    
    /**
     * Usato per l'app Android e iOS.
     * Restituisce i dati di una votazione
     * 
     * @param type $id
     */
    public function actionViewSocioApp($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $votazione          = $this->findVotazioneModel($id);
        $soci               = $this->getSociConDirittoDiVoto($id);
        $votazione_has_voti = $soci = (new \yii\db\Query())
                            ->select("*, COUNT(*) tot_voti")
                            ->from('{{%votazione_has_voti}} vhv')
                            ->innerJoin('{{%voti}} v', 'vhv.id_voto = v.id')
                            ->innerJoin('{{%soci}} s', 's.id = v.id_socio')
                            ->where(['vhv.id_votazione' => $id])
                            ->groupBy('v.id_socio')
                            ->all();
        $rosa_eletti    = $soci = (new \yii\db\Query())
                            ->select("*, COUNT(*) tot_voti")
                            ->from('{{%votazione_has_voti}} vhv')
                            ->innerJoin('{{%voti}} v', 'vhv.id_voto = v.id')
                            ->innerJoin('{{%soci}} s', 's.id = v.id_socio')
                            ->where(['vhv.id_votazione' => $id])
                            ->groupBy('v.id_socio')
                            ->orderBy("tot_voti DESC")
                            ->limit(5)
                            ->all();
        
        return [[
            'votazione_has_voti'    => $votazione_has_voti,
            'votazione'             => $votazione,
            'soci'                  => $soci,
            'rosa_eletti'           => $rosa_eletti,
        ]];
        
        /*return $this->render('view-socio',[
            'votazione'             => $votazione,
            'soci'                  => $soci,
            'votazione_has_voti'    => $votazione_has_voti,
            'rosa_eletti'           => $rosa_eletti,
        ]);*/
    }
    
    /**
     * Finds the Votazione model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Numero Protocollo
     * @return Verbali the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findVotazioneModel($id)
    {
        if (($model = Votazione::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
