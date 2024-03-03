<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div id="iscrizioni-add">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="actions">
        <?= Html::a('<i class="fas fa-table"></i>', ['sponsor'], ['class' => 'btn btn-warning']) ?>
        <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
    </div>
    
    <div>
        <?= $form->field($model, 'sponsor')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'immagine')->fileInput() ?>
   </div>
    <?php ActiveForm::end(); ?>
</div>