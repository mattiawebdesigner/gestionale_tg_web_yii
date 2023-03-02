<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Nominativo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nominativo-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="form-group">
        <?= Html::submitButton('<i class="fa-solid fa-floppy-disk"></i> ' . Yii::t('app', 'Aggiorna lo stand'), ['class' => 'btn btn-success']) ?>
    </div>
    
    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'n_postazione')->textInput(['maxlength' => true])->label(Yii::t('app', 'Postazione')) ?>
    
    <?= $form->field($model, 'tipologia')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'dimensione')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'logo')->fileInput() ?>
    
    <?php if($type=="update"): ?>
    <?= Html::img($model->logo) ?>
    <?php endif; ?>
    
    <?php ActiveForm::end(); ?>
</div>



<?php