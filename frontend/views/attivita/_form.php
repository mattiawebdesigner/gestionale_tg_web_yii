<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Attivita */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attivita-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descrizione')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'data_ultima_modifica')->textInput() ?>

    <?= $form->field($model, 'data_inserimento')->textInput() ?>

    <?= $form->field($model, 'luogo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_attivita')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
