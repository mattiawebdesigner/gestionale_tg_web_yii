<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AttivitaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attivita-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'foto') ?>

    <?= $form->field($model, 'descrizione') ?>

    <?= $form->field($model, 'data_ultima_modifica') ?>

    <?php // echo $form->field($model, 'data_inserimento') ?>

    <?php // echo $form->field($model, 'luogo') ?>

    <?php // echo $form->field($model, 'data_attivita') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
