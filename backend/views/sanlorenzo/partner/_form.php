<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\SnlPartner;

/* @var $this yii\web\View */
/* @var $model backend\models\Nominativo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nominativo-form">

    <?php $form = ActiveForm::begin(); ?>

		<div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    
    <?= $form->field($model, 'partner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_di_sponsorizzazione')->textInput() ?>
    
    <?= $form->field($model, 'postazioni')->textInput() ?>
    
    <?= $form->field($model, 'ordinamento')->textInput(['type' => 'number', 'value' => $max]) ?>
    
    <?php if($type=='create'): ?>
        <?= $form->field($model, 'logo')->fileInput(['required' => true]) ?>
    <?php else: ?>
        <?= $form->field($model, 'logo')->fileInput() ?>
    <?php endif; ?>
    
    <?= $form->field($model, 'sito_internet')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'note')->textarea(['maxlength' => true, 'rows' => '10']) ?>

    <?= $form->field($model, 'tipologia_di_partner')->dropDownList([
        SnlPartner::SPONSOR => 'Sponsor',
        SnlPartner::PA_ASSOCIAZIONI => 'Pubblica Amministrazione o Associazione',
    ]) ?>
    
    <?php if($type=='update'): ?>
        <img src="<?= $model->logo?>" />
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>



<?php