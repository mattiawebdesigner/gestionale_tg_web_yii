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
        <?= Html::submitButton('<i class="fa-solid fa-floppy-disk"></i> ' . Yii::t('app', 'Salva il nuovo artista'), ['class' => 'btn btn-success']) ?>
    </div>
    
    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'postazione')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'tipologia')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'descrizione')->textarea(['maxlength' => true, 'rows' => '10']) ?>
    
    <?php ActiveForm::end(); ?>
</div>



<?php