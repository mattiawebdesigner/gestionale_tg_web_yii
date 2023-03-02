<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VociSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="voci-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'voce') ?>

    <?= $form->field($model, 'prezzo') ?>

    <?= $form->field($model, 'data_contabile') ?>

    <?= $form->field($model, 'data_inserimento') ?>

    <?php // echo $form->field($model, 'ultima_modifica') ?>

    <?php // echo $form->field($model, 'tipologia') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
