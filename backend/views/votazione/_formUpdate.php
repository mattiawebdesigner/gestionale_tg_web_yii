<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$tot_info = 0;
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
    
        <?php
        $info = json_decode($votazione->info);?>
        
    
        <div class="flex gap-1">
        
        
        <?php 
        foreach ($info as $k => $i) : ?>
            <div>
                <div class="data">
                <label for="data-<?= $k ?>"><?= Yii::t('app', 'Data') ?></label>
                <?= Html::input('date', "Votazione[info][{$k}][data]", $i->data, ['class' => 'form-control', 'id' => 'data-'.$k]) ?>
            </div>
            <div class="ora-inizio">
                <label for="ora-inizio-<?= $k ?>"><?= Yii::t('app', 'Ora inizio') ?></label>
                <?= Html::input('time', "Votazione[info][{$k}][ora_inizio]", $i->ora_inizio, ['class' => 'form-control', 'id' => 'ora-inizio-'.$k]) ?>
            </div>
            <div class="ora-fine">
                <label for="ora-fine-<?= $k ?>"><?= Yii::t('app', 'Ora fine') ?></label>
                <?= Html::input('time', "Votazione[info][{$k}][ora_fine]", $i->ora_fine, ['class' => 'form-control', 'id' => 'ora-fine-'.$k]) ?>
            </div>
            </div>
            
            <?php $tot_info ++ ?>
        <?php endforeach; ?>
            
        <?= Html::input('hidden', '', $tot_info, ['data-tot-info' => true]) ?>
        </div>
    

        <div class="form-group">
            <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva votazione'), ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    
</div>

<?php

$this->registerJsFile("@web/js/votazione.js", ['depends' => \yii\web\JqueryAsset::class]);
//