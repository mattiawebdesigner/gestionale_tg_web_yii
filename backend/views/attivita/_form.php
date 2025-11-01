<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\models\Attivita */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="showItem" class="attivita-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <div>
            <div class="img-box">
        <?= $form->field($model, 'foto')->textInput(['maxlength' => true, 'class' => 'append-url form-control', 'readonly' => 'readonly']) ?>
        <div class="clear-img"><i class="fas fa-times-circle"></i></div>
    </div>

    <div class="img img-show-media">
            <?= Html::img($model->foto, [
                'style' => 'width: 250px;'
            ])?>
    </div>

    <div class="btn btn-info open-iframe"><?= Yii::t('app', 'Galleria immagini') ?></div>
    </div>

    <?= $form->field($model, 'descrizione')->widget(TinyMce::className(), [
        'options' => ['rows' => 20],
        'language' => 'it',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);?>

    <?= $form->field($model, 'luogo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_attivita')
                ->textInput([
                    'type' => 'datetime-local', 
                    'value' => str_replace(" ", "T", $model->data_attivita)
                ]) ?>
    
    <div data-generate>
        <div data-add><i class="fa fa-plus"></i></div>
        
        <div data-append></div>
    </div>
	
    <?= Yii::t('app', 'Evento a pagamento?') ?>

    <?= $form->field($model, 'pagamento')->radioList(['no' => Yii::t('app','No'), 'yes' => Yii::t('app','Si')], [
        'data-showItem' => 'true',
        'data-showItemCheck' => 'yes',
        'data-showItemCheckNo' => 'no',
        'data-showItemClassView' => 'costo',
        'data-type' => 'list'
    ])->label(false) ?>
	
    <?= $form->field($model, 'costo', ['options' => [
        'class' => 'form-group field-attivita-costo required costo ',
        'data-hide' => (empty($model->pagamento==="yes"))?'true':'false',
    ]])->textInput()->label(Yii::t('app', 'Quota') . ' (&euro;)') ?>
	
    <?= $form->field($model, 'prenotazione')->radioList(
            ['no' => Yii::t('app','No'), 'yes' => Yii::t('app','Si')], [
        'data-showItem' => 'true',
        'data-showItemCheck' => 'yes',
        'data-showItemCheckNo' => 'no',
        'data-showItemClassView' => 'posti',
        'data-type' => 'list'
    ]) ->label(Yii::t('app', 'Prenotazione disponibile?')) ?>

    <?= $form->field($model, 'posti_disponibili', ['options' => [
        'class' => 'form-group field-attivita-posti_disponibili posti ',
        'data-hide' => (empty($model->posti_disponibili))?'true':'false',
    ]])->textInput(['type' => 'number']) ?>
    
    <?= $form->field($model, 'annullato')->radioList(
            ['no' => Yii::t('app','No'), 'yes' => Yii::t('app','Si')]) ->label(Yii::t('app', 'Annullato?')) ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<?php
$this->registerCssFile("@web/css/iframe.css");
$this->registerCssFile("@web/css/media.css");
$this->registerCss('
    [data-hide="true"]{
        display: none;
    }
');

$this->registerJsFile("@web/js/media.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/showItem.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/utility/generateElement.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJs("jQuery('#iframe').media({
    open        : '.open-iframe',
    attachment  : 'input.append-url' 
});
jQuery('#showItem').showItem({
    clear : false
});
jQuery('[data-generate]').generateElement({
    'element' : '<div class=\"form-group field-attivita-data_attivita\">' +
                    '<label class=\"control-label\" for=\"attivita-data_attivita\">Data Attivita</label>' +
                    '<input type=\"datetime-local\" id=\"attivita-data_attivita\" class=\"form-control\" name=\"Attivita[data_attivita][]\" value=\"\">' +
                    
                    '<div class=\"help-block\"></div>'+
                '</div>'
});
", View::POS_END);
?>