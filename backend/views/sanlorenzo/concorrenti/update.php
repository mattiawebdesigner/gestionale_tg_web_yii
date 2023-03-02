<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Aggiornamento concorrente: {c}', [
    'c' => $model->nome_gruppo,
]);
?>
<div id="concorrente-create">
    <h1><i class="fa-solid fa-user"></i> <?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        
        <div class="action-bar">
            <?= Html::a('<i class="fa-solid fa-table"></i>', ['sanlorenzo/subscribers'], ['title' => Yii::t('app', 'Tutti gli iscritti')], ['class' => 'btn btn-info']) ?> 
            <?= Html::submitButton('<i class="fa fa-save"></i> '.Yii::t('app', 'Aggiorna i dati del referente'), ['class' => 'btn btn-success']) ?>
        </div>
    
        <?php //Allegao A ?>
        <h3><?= Yii::t('app', 'Allegato A - Modulo di iscrizione'); ?></h3>
        <h6><?= Yii::t('app', 'Riservato al responsabile del gruppo'); ?></h6>
        <p>&nbsp;</p>
        <?= $form->field($model, 'nome_gruppo')->textInput()->label("Nome gruppo (se solista inserire il proprio nome e cognome)") ?>
        <?= $form->field($model, 'nome')->textInput() ?>
        <?= $form->field($model, 'cognome')->textInput() ?>
        <?= $form->field($model, 'data_di_nascita')->textInput([
            'type' => 'date',
        ]) ?>
        <div class="flex gap-1">
            <div class="w-100 f-shrink-05">
                <?= $form->field($model, 'luogo_di_nascita')->textInput() ?>
            </div>
            <div class="w-100 f-shrink-2">
                <?= $form->field($model, 'provincia_nascita')->textInput() ?>
            </div>
        </div>
        
        <?= $form->field($model, 'citta_residenza')->textInput() ?>
        
        <div class="flex gap-1">
            <div class="w-100 f-shrink-05">
                <?= $form->field($model, 'indirizzo')->textInput() ?>
            </div>
            <div class="w-100 f-shrink-2">
                <?= $form->field($model, 'numero_civico')->textInput() ?>
            </div>
            <div class="w-100 f-shrink-2">
                <?= $form->field($model, 'provincia_residenza')->textInput() ?>
            </div>
        </div>
        <div class="flex gap-1">
            <div class="w-100">
                <?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>
            </div>
            <div class="w-100">
                <?= $form->field($model, 'cellulare')->textInput() ?>
            </div>
        </div>
        <?= $form->field($model, 'brani')->textarea([
            'rows' => 2,
            'placeholder' => Yii::t('app', 'Inserire i due brani scelti, uno per riga'),
        ]) ?>
        
        <?= $form->field($model, 'note')->textarea(['rows' => 10]) ?>
        
        
        <div class="action-bar">
            <?= Html::submitButton('<i class="fa fa-save"></i> '.Yii::t('app', 'Aggiorna i dati del referente'), ['class' => 'btn btn-success']) ?>
        </div>
        
    <?php ActiveForm::end(); ?>
    
</div>