<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Iscritto: {name}', [
    'name' => $model->nome." ".$model->cognome,
]);
?>
<div class="sanlorenzo-concorrenti-view">
    <h1>
        <?= Html::a('<i class="fa fa-pen"></i>', ['sanlorenzo/concorrenti-update', 'id' => $model->id], ['title' => Yii::t('app', 'Aggiorna dati del referente')]) ?>
        <?= Html::a('<i class="fa-solid fa-table"></i>', ['sanlorenzo/subscribers'], ['title' => Yii::t('app', 'Tutti gli iscritti')]) ?> 
        <?= Html::encode($this->title) ?>
    </h1>
    
    <?php if($componenti_search<>null) : ?>
    <h4 class="item"><?= Yii::t('app', 'Nome del gruppo') ?> <strong><?= $model->nome_gruppo ?></strong></h4>
    <hr />
    
    <?php endif; ?>
    
    <h4><i class="fa-solid fa-user"></i> <?= Yii::t('app', 'Dati del rappresentante') ?></h4>
    
    <div class="item"><?= $model->nome?> <?= $model->cognome ?></div>
    <div class="item">
        <?= Yii::t('app', 'Nato il') ?> <strong><?= $model->data_di_nascita ?> </strong>
        <?= Yii::t('app', 'a') ?> <strong><?= $model->luogo_di_nascita ?> (<?= $model->provincia_nascita ?>)</strong>
    </div>
    <div class="item">
        <?= Yii::t('app', 'Residente a') ?> <strong><?= ucwords($model->citta_residenza) ?></strong>
        <?= Yii::t('app', 'in via/p.zza') ?> <strong><?= ucwords($model->indirizzo) ?> <?= $model->numero_civico ?> (<?= $model->provincia_residenza ?>)</strong>
    </div>
    <div class="item">Email: <?= Html::a($model->email, 'mailto: '.$model->email) ?></div>
    <div class="item"><?= Yii::t('app', 'Cellulare') ?>: <?= Html::a($model->cellulare, 'tel: '.$model->cellulare) ?></div>
    
    <hr />
    
    <div class="item">
        <strong>Brani portati</strong>
        <ol>
        <?php foreach (explode(PHP_EOL, $model->brani) as $brano): ?>
            <li><?= $brano ?></li>
        <?php endforeach; ?>
    </div>
    
    <hr />
    <h4>Note</h4>
    <div><?= str_replace(["\n", " "], ["<br />", "\t"], $model->note) ?></div>
    <hr />
    
    <h4><i class="fa-solid fa-file-pdf"></i> <?= Yii::t('app', 'Allegati') ?></h4>
    <ul>
    <?php foreach($allegati as $allegato) : ?>
        <li><?= Html::a($allegato->nome_allegato, $allegato->allegato, ['target' => '_blank']) ?></li>
    <?php endforeach; ?>
    </ul>
    
    <?php if(isset($componenti)): ?>
    <hr />
    <h4><i class="fa-solid fa-users"></i> <?= Yii::t('app', 'Componenti del gruppo') ?></h4>
    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Aggiungi un componente'), 
                ['sanlorenzo/nominativo-create', 'concorrente_id' => $model->id], 
                ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa-solid fa-arrow-rotate-right"></i> '.Yii::t('app', 'Ricarica l\'allegato A'), 
                ['sanlorenzo/concorrenti-refresh-allegato-a', 'id' => $model->id], 
                ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $componenti,
        'filterModel' => $componenti_search,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nominativo',
            'strumento',
            
            [
                'label' => 'Data di nascita',
                'attribute' => 'data_di_nascita',
                'value' => function($model){
                    return date('d-m-Y', strtotime($model->data_di_nascita));
                }
                ],
            
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, backend\models\SnlNominativi $model, $key, $index, $column) {
                    return Url::toRoute(['/sanlorenzo/nominativi-'.$action, 'id' => $model->id, 'concorrente_id' => $model->concorrente ]);
                },
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php endif; ?>
</div>


<?php
$this->registerCssFile('@web/css/sanlorenzo/concorrenti-view.css', ['depends' => \yii\bootstrap4\BootstrapAsset::class]);