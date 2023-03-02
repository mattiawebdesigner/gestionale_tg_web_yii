<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\IntestazioneSocial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="intestazione-social-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_intestazione')->textInput() ?>

    <?= $form->field($model, 'id_social')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
