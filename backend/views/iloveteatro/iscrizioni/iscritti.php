<?php
use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\IltIscrizioni;
use yii\grid\ActionColumn;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Iscritti al festival');
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Iscrivi una compagnia'), ['add-troupe'], ['class' => 'btn btn-success']) ?>
</p>

<div class="festival-info container">
    <div class="row">
        <div class="col col-sm-12">
            <?= Yii::t('app', 'Festival') ?>
            <strong><?= Yii::$app->params['site_name'] ?></strong>
            <?= Yii::t('app', 'anno: ') ?>
            <strong><?= $festival->anno ?></strong>
        </div>
    </div>
    <div class="row">
        <div class="col col-sm-12">
            <?= Yii::t('app', 'Inizio del festival: ') ?>
            <strong><?= $festival->inizio ?></strong>
            <?= Yii::t('app', 'Fine del festival: ') ?>
            <strong><?= $festival->fine ?></strong>
        </div>
    </div>
</div>

<p></p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'id',
        'compagnia',
        'titolo_spettacolo', 
        //'codice_fiscale_compagnia',
        //'partita_iva',
        'nome_referente',
        'cognome_referente',
        'codice_fiscale_referente',
        [
            'attribute' => 'attivo',
            'value' => function ($model){
                return $model->attivo === IltIscrizioni::DELETED ? Yii::t('app', 'Iscrizione rifiutata') : 
                           ( $model->attivo === IltIscrizioni::TO_BE_APPROVED ? Yii::t('app', 'Iscrizione da approvare') : 
                                ($model->attivo === IltIscrizioni::SUBSCRIBED ? Yii::t('app', 'Iscrizione approvata') : '')
                            );
            }
        ],

        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, IltIscrizioni $model, $key, $index, $column) {
                return Url::toRoute(['iscrizioni-'.$action, 'id' => $model->id]);
            },
            'template' => '{view} {update} {approved} {reject} {switch}',
            'buttons' => [
                'reject' => function($url, $model){
                    if($model->attivo === IltIscrizioni::TO_BE_APPROVED)
                        return Html::a("<i class='fas fa-sign-out-alt'></i>", ['/iloveteatro/iscrizioni-delete', 'id'=>$model->id], ['title' => Yii::t('app', 'Rifiuta iscrizione')]);
                    
                },
                'approved' => function($url, $model){
                    if($model->attivo === IltIscrizioni::TO_BE_APPROVED)
                        return Html::a("<i class='fas fa-sign-in-alt'></i>", ['/iloveteatro/approved-troupe', 'id'=>$model->id], ['title' => Yii::t('app', 'Approva iscrizione')]);
                },
                'switch' => function($url, $model){
                    if($model->attivo === IltIscrizioni::DELETED)
                        return Html::a("<i class='fas fa-sign-in-alt'></i>", ['/iloveteatro/approved-troupe', 'id'=>$model->id], ['title' => Yii::t('app', 'Approva iscrizione')]);
                    else if($model->attivo === IltIscrizioni::SUBSCRIBED)
                        return Html::a("<i class='fas fa-sign-out-alt'></i>", ['/iloveteatro/iscrizioni-delete', 'id'=>$model->id], ['title' => Yii::t('app', 'Rifiuta iscrizione')]);
                }
            ]
        ],
    ],
    
]); ?>