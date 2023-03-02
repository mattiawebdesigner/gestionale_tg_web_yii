<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SocioAnnoSociale */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="socio-anno-sociale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'socio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_registrazione')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
