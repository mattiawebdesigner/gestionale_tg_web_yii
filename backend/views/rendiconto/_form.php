<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Rendiconto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rendiconto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'anno')
             ->dropDownList(
                yii\helpers\ArrayHelper::map(backend\models\Anno::find()->all(), 'anno', 'anno')
    )->label(Yii::t('app', 'Categoria')) ?>
    
    <div class="form-group">
        <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
