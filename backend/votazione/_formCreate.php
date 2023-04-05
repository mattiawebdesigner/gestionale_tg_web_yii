<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div id="rendiconto" class="voci-form container">
    <?php //Form to copy ?>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($votazione, 'anno')->textInput() ?>
    
        <?= $form->field($votazione, 'luogo')->textInput() ?>
    
        <div>
            <?= Yii::t('app', 'Data della votazione') ?>
            
            <div data-add="data-votazione" class="btn" title="<?= Yii::t('app', 'Aggiungi data') ?>">
                <i class="fa-solid fa-plus"></i>
            </div>
            
            <div data-container="data-votazione"></div>
        </div>
        
    

        <div class="form-group">
            <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva votazione'), ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>

<?php

$this->registerJsFile("@web/js/votazione.js", ['depends' => \yii\web\JqueryAsset::class]);
