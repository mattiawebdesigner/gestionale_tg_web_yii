<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use backend\models\Categorie;
use backend\models\Proprietario;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProdottoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Prodotti');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodotto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Nuovo Prodotto'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <div class="col col-sm-12 col-md-12 col-lg-12">
        <p><?= Yii::t('app', 'Digita cosa vuoi cercare') ?></p>
        
        <div>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'method' => 'post'
            ]) ?>
            <div class="form-group">
                <?= Html::textarea('ricerca', '', ['class' => 'form-control']) ?>
            </div>
            
            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('<i class="fa-solid fa-magnifying-glass"></i> '.Yii::t('app', 'Cerca'), ['class' => 'btn btn-primary']) ?>
                    <?php if($pulisciRicerca) : ?>
                    <?= Html::a('<i class="fa-solid fa-broom"></i> '.Yii::t('app', 'Pulisci ricerca'), ['prodotto/index', 'pulisci' => true], ['class' => 'btn btn-info']) ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nome',
            //'categoria_id',
            //'descrizione:ntext',
            'quantita' => [
                'label' => Yii::t('app', 'Quantita\''),
                'attribute' => 'quantita'
            ],
            //'data_inserimento',
            
            /*[//Description
                'attribute' => "descrizione",
                'label' => 'Descrizione',
                'value' => function ($model) {
                    return '[...]';
                }
            ],*/
            
            [//Category name
                'attribute' => "categoria_id",
                'label' => 'Categoria',
                'value' => function ($model) {
                    if(is_object($model)){
                        return Categorie::findOne(['categoria_id'=>$model->categoria_id])->categoria;
                    }else if(is_array($model)){
                        return Categorie::findOne(['categoria_id'=>$model['categoria_id']])->categoria;
                    }
                    
                    return '';//nessuno dei tipi precedenti, previene l'errore
                }
            ],
            
            'proprietario_id' => [
                'label' => Yii::t('app', 'Proprietario'),
                'attribute' => 'proprietario_id',
                'value' => function($model){
                    if(is_object($model)){
                        return Proprietario::findOne(['id'=>$model->proprietario_id])->proprietario;
                    }else if(is_array($model)){
                        return Proprietario::findOne(['id'=>$model['proprietario_id']])->proprietario;
                    }
                    return '';//nessuno dei tipi precedenti, previene l'errore
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width:260px;'],
                'header' => '',
                'template' => '{view} {update} {delete}',
                /*'buttons' => [

                    //view button
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-search"></span>View', $url, [
                                    'title' => Yii::t('app', 'View'),
                                    'class'=>'btn btn-primary btn-xs',                                  
                        ]);
                    },
                ],*/
                'urlCreator' => function ($action, $model, $id, $index){
                    //if ($action === 'view') {
                        $id = is_array($model) ? $model['id'] : $id;
                        
                        $url = \yii\helpers\Url::to(["prodotto/{$action}", 'id' => $id]);
                        return $url;
                    //}
                }
            ],
        ],
    ]); ?>


</div>

<?php
$this->registerCssFile("@web/css/fontawesome-free-6.0.0-beta2-web/css/all.min.css");
$this->registerCssFile('@web/css/pagination.css');



