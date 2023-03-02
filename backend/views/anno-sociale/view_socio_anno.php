<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AnnoSociale */

$this->title = Yii::t('app', 'Socio').": ".$socio->nome." ".$socio->cognome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Anno Sociales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aggiungi socio'), 'url' => ['add', 'anno' => $model->anno]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="anno-sociale-view">

    <h1><?= Html::encode($this->title) ?></h1>
	
	<h3><?= Yii::t('app', 'Informazioni socio');?></h3>
	
    <?= DetailView::widget([
        'model' => $socio,
        'attributes' => [
            'id',
            'nome',
            'cognome',
            'indirizzo',
            'email:email',
            'data_registrazione',
            'data_di_nascita',
            [
                'label' => Yii::t('app', 'Validita'),
                'value' => ($annoSocio->validita == "si") ? '<i class="fas fa-thumbs-up"></i>' : '<i class="fas fa-thumbs-down"></i>',
                'format' => 'html',
            ],
            [
                'label' => Yii::t('app', 'Socio sostenitore'),
                'value' => ($annoSocio->sostenitore == "si") ? '<i class="fas fa-thumbs-up"></i>' : '<i class="fas fa-thumbs-down"></i>',
                'format' => 'html',
            ],
        ],
    ]) ?>
	
	
	<h3><?= Yii::t('app', 'Informazioni anno sociale');?></h3>
	
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'anno',
            'quotaSocioOrdinario' => [
                'label' => Yii::t('app', 'Quota socio ordinario'),
                'attribute' => 'quotaSocioOrdinario',
                'value' => function($model){
                    return $model->quotaSocioOrdinario;
                },
            ],
            'quotaSocioSostenitore' => [
                'label' => Yii::t('app', 'Quota socio sostenitore'),
                'attribute' => 'quotaSocioSostenitore',
                'value' => function($model){
                    return $model->quotaSocioSostenitore;
                },
            ],
        ],
    ]) ?>

</div>

<?php
$this->registerCssFile("@web/css/fontawesome-free-6.0.0-beta2-web/css/all.min.css")
?>