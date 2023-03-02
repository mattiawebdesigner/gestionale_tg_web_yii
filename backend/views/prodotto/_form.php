<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Categorie;
use backend\models\Proprietario;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\models\Prodotto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prodotto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true])->label(Yii::t('app', 'Prodotto')) ?>
    
    <?= $form->field($model, 'categoria_id')
             ->dropDownList(
                 ArrayHelper::map(Categorie::find()->all(), 'categoria_id', 'categoria')
    )->label(Yii::t('app', 'Categoria')) ?>
    
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

    <?= $form->field($model, 'quantita')->textInput(['type'=>'number']) ?>
	
    <?= $form->field($model, 'proprietario_id')
             ->dropDownList(
                 ArrayHelper::map(Proprietario::find()->all(), 'id', 'proprietario')
    )->label(Yii::t('app', 'Proprietario')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
