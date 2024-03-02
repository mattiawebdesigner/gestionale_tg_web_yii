<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

?>
<div id="iscrizioni-add">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="actions">
        <?= Html::a('<i class="fas fa-table"></i>', ['sponsor'], ['class' => 'btn btn-warning']) ?>
        <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
    </div>
    
    <div>
        <?= $form->field($model, 'sponsor')->dropDownList(ArrayHelper::map(app\models\IltSponsor::find()->asArray()->all(), 'id', 'sponsor')) ?>
        <?= $form->field($model, 'festival')->hiddenInput(['value' => $festival->festival])->label(false) ?>
   </div>
    <?php ActiveForm::end(); ?>
</div>