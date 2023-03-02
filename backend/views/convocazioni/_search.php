<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ConvocazioniSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="convocazioni-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'numero_protocollo') ?>

    <?= $form->field($model, 'ordine_del_giorno') ?>

    <?= $form->field($model, 'oggetto') ?>

    <?= $form->field($model, 'data') ?>

    <?= $form->field($model, 'data_inserimento') ?>

    <?php // echo $form->field($model, 'ultima_modifica') ?>

    <?php // echo $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'contenuto') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
