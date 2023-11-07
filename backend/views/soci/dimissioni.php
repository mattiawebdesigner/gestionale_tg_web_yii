<?php
/**
 Pagina per gestire le dimissioni dei soci.
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Dimissioni: {socio}', [
    'socio' => $model->cognome." ".$model->nome,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'I soci'), 'url' => ['print-show']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soci-dimissioni">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'data_dimissioni')->textInput(['maxlength' => true, 'type' => 'date']) ?>
    
        <?= $form->field($model, 'file_dimissioni')->fileInput() ?>
        
        <div class="form-group">
            <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Carica dimissioni'), ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>