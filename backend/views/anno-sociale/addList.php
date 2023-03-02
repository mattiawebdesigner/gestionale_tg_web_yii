<?php
use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\SocioAnnoSociale;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AnnoSocialeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Aggiungi socio');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socio-anno-sociale">
	
    <h1><?= Html::encode($this->title) ?></h1>
    <h4><?= Html::encode(Yii::t('app', 'Anno sociale')." ".$anno) ?></h4>
    
    <p>
        <?= Html::a('<i class="fas fa-user-plus"></i> '.Yii::t('app', 'Nuovo socio'), ['/soci/create', 'anno' => $anno], ['class' => 'btn btn-success']) ?>
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
            //'data_di_nascita',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{add} ',
                'buttons' => [
                    'add' => function ($url, $model) use ($anno) {
                        return !SocioAnnoSociale::findOne(['anno' => $anno, 'socio' => $model->id]) ? Html::a(//Add socio
                            '<i class="fas fa-user-plus"></i>',
                                ['/anno-sociale/add', 'socio' => $model->id, 'anno' => $anno, "action" => 'user'],
                            [
                                'title' => 'Aggiungi all\'anno selezionato il socio',
                            ]
                        ): Html::a(//Remove socio
                                '<i class="fas fa-user-minus"></i>',
                                ['/anno-sociale/remove', 'id' => $model->id, 'anno' => $anno, "action" => 'user'],
                                [
                                    'title' => 'Aggiungi all\'anno selezionato il socio',
                                ]);
                    },
                ],
            ],
        ],
    ]); ?>
    
</div>

<?php
$this->registerCssFile("@web/css/fontawesome-free-6.0.0-beta2-web/css/all.min.css");
$this->registerCssFile("@web/css/pagination.css");