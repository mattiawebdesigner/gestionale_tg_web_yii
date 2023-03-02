<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Attivita */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="showItem" class="attivita-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <!--<pre>
        <?php print_r($model) ?>
    </pre>-->
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'prenotazioni')->textInput(['type' => 'number', 'min' => 1, 'max' => $placesLeft+$model->prenotazioni]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>