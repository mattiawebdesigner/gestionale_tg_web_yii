<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Partecipazione */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partecipazione-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'attivita')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nominativo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_partecipazione')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
