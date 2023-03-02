<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div id="iscrizioni-add">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="actions">
        <?= Html::a('<i class="fas fa-table"></i>', ['/iloveteatro/iscritti'], ['class' => 'btn btn-warning']) ?>
        <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
    </div>
    
    <div>
        <?= $form->field($model, 'compagnia')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'codice_fiscale_compagnia')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'partita_iva')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'nome_referente')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'cognome_referente')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'codice_fiscale_referente')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'festival')->hiddenInput(['value' => $festival->id])->label(false) ?>
        
        <?= $form->field($pdf, 'multipleFile[]')->fileInput(['multiple' => true])->label(Yii::t('app', 'Allegati')) ?>
   </div>
    <?php ActiveForm::end(); ?>
</div>