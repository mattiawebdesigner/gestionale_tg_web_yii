<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RendicontoVoci */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rendiconto-voci-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_rendiconto')->textInput() ?>

    <?= $form->field($model, 'id_voce')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
