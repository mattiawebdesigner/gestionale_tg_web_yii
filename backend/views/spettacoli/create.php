<?php
/**
 * Pagina di inserimento di un nuovo inserimento
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VerbaliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Nuovo spettacolo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spettacoli'), 'url' => ['manage']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verbali-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="programming-show ilove-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <div class="submit">
        <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
    </div>
    
    <?= $form->field($model, 'spettacolo')->textInput([
                'placeholder' => Yii::t('app', 'Spettacolo'),
                'class' => 'form form-control title'
            ])->label(false) ?>
    
    <?= $form->field($model, 'data')->textInput([
            'placeholder' => Yii::t('app', 'Data dello spettacolo'),
            'type' => 'date'
        ]) ?>
    
    <div class="flex gap-1">
        <?= $form->field($model, 'ora_porta')->textInput([
            'placeholder' => Yii::t('app', 'Apertura porte'),
            'type' => 'time'
        ]) ?>
        
        <?= $form->field($model, 'ora_sipario')->textInput([
            'placeholder' => Yii::t('app', 'Inizio spettacolo'),
            'type' => 'time'
        ]) ?>
    </div>
    
    <div class="flex gap-1">
        <?= $form->field($model, 'banner')->fileInput()
                ->label('<i class="fas fa-plus-circle"></i> '.Yii::t('app', 'Copertina'), [
                        'class' => 'btn btn-warning add-slide',
                        'style' => 'background-image: url('.$model->banner.')',
                    ],
                ) ?>
        
        <?= $form->field($model, 'locandina')->fileInput()
                ->label('<i class="fas fa-plus-circle"></i> '. Yii::t('app', 'Locandina'), [
                        'class' => 'btn btn-warning add-slide',
                        'style' => 'background-image: url('.$model->locandina.')',
                ]) ?>
    </div>
    
    <div class="flex gap-1">
        <?= $form->field($model, 'piantina')->dropDownList(
            \yii\helpers\ArrayHelper::map($piantine, 'id', 'teatro')
        ) ?>
    </div>
    
    
    <?php ActiveForm::end(); ?>
    
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/ilove-form.css');