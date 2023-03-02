<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Impostazioni');
?>
<div class="sanlorenzo-settings-index">
    <h1><i class="fa-solid fa-gear"></i> <?= Html::encode($this->title) ?></h1>
    
    <pre>
        <?php //print_r($social) ?>
    </pre>
    
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    
    
    <section class="all-social container">
        <h4><?= Yii::t('app', 'Social') ?></h4>
        
        <div class="row">
            <?= $form->field($new_social, 'id[]')->hiddenInput(['value' => 0])->label(false) ?>
            <?= $form->field($new_social, 'social[]')->textInput() ?>
            <?= $form->field($new_social, 'icona[]')->textInput() ?>
            <?= $form->field($new_social, 'link[]')->textInput() ?>
        </div>
        
        <?php if($social <> null): ?>
            <?php foreach($social as $s) : ?>
            <div class="social row">
            <?= $form->field($s, 'id[]')->hiddenInput(['value' => $s->id, 'id' => 'social-id-'.$s->social])->label(false) ?>
            <?= $form->field($s, 'social[]')->textInput(['value' => $s->social, 'id' => 'social-'.$s->social]) ?>
            <?= $form->field($s, 'icona[]')->textInput(['value' => $s->icona, 'id' => 'social-icona-'.$s->social])
                                            ->label('<i class="'.$s->icona.'"></i> '.Yii::t('app', 'Icona (fontawesame)')) ?>
            <?= $form->field($s, 'link[]')->textInput(['value' => $s->link, 'id' => 'social-link-'.$s->social]) ?>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
    
    <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva e chiudi'), ['class' => 'btn btn-success']) ?>
    
    
    <?php ActiveForm::end(); ?> 
</div>