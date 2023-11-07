<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AnnoSocialeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Elenco dei soci');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'I soci'), 'url' => ['print-show']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socio-anno-sociale">
	
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('<i class="fas fa-user-plus"></i> '.Yii::t('app', 'Nuovo socio'), ['/soci/create'], ['class' => 'btn btn-success']) ?>
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