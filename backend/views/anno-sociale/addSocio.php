<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AnnoSociale */
/* @var $model backend\models\Soci */

$this->title = $socio->nome." ".$socio->cognome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aggiungi socio'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="anno-sociale-addSocio">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin(); ?>
    
        <?= $form->field($model, 'socio')->textInput(['type' => 'hidden'])->label(false) ?>
    
        <?= $form->field($model, 'anno')->textInput(['type' => 'hidden'])->label(false) ?>
    
        <?= $form->field($model, 'validita')->dropDownList(['si' => Yii::t('app', 'Si'), 'no' => Yii::t('app', 'No')]) ?>
        
        <?= $form->field($model, 'sostenitore')->dropDownList(['si' => Yii::t('app', 'Si'), 'no' => Yii::t('app', 'No')]) ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>


	<h3> <?= Yii::t('app', 'Dati del socio') ?></h3>
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
        ],
    ]) ?>
    
    
</div>

<?php
$this->registerCssFile("@web/css/fontawesome-free-6.0.0-beta2-web/css/all.min.css")
?>