<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div id="iscrizioni-add">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="actions">
        <?= Html::a('<i class="fas fa-table"></i>', ['partner'], ['class' => 'btn btn-warning']) ?>
        <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
    </div>
    
    <div>
        <?= $form->field($model, 'partner')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'sito_internet')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'postazioni')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'note')->textarea(['rows' => 15]) ?>
        
        <?= $form->field($model, 'logo')->fileInput() ?>
        
        <?= $form->field($model, 'tipologia_di_partner')->hiddenInput(['value' => backend\models\IltPartner::PARTNER])->label(false) ?>
        <?= $form->field($model, 'festival')->hiddenInput(['value' => $festival->festival])->label(false) ?>
   </div>
    <?php ActiveForm::end(); ?>
</div>