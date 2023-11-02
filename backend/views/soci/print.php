<?php
/**
 * Pagina per la stampa dei soci.
 * 
 * Questa pagina è utile per stampare l'elenco dei soci attivi.
 * L'elenco viene visualizzato a schermo e se necessario viene stampato
 * cliccando l'apposito pulsante.
 */
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SociSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Elenco firme');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soci-print">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('<i class="fas fa-print"></i> '.Yii::t('app', 'Stampa elenco firme'), ['/soci/print'], ['class' => 'btn btn-success']) ?>
    </p>
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            
            'cognome',
            'nome',
            'email:email',
            //'indirizzo',
            //'data_registrazione',
            'data_di_nascita',

            //['class' => 'yii\grid\ActionColumn',],
            [
                'class' => yii\grid\ActionColumn::className(),
                'urlCreator' => function ($action, backend\models\Soci $model, $key, $index, $column) {
                    return yii\helpers\Url::toRoute([$action, 'id' => $model->id, 'anno' => date('Y')]);
                },
                'template' => '{view} {update}',
            ],
        ],
    ]); ?>
</div>


<?php
$this->registerCssFile("@web/css/fontawesome-free-6.0.0-beta2-web/css/all.min.css");
$this->registerCssFile('@web/css/pagination.css',['depends' => yii\bootstrap4\BootstrapAsset::class]);