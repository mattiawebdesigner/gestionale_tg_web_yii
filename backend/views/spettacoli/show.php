<?php
/**
 * Visualizza i dettagli dello spettacolo
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VerbaliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '{name}', [
    'name' => $model->spettacolo,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spettacoli'), 'url' => ['manage']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
    
<div class="programming-show ilove-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <div class="submit">
        <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-trash-alt"></i>', ['/iloveteatro/delete-show', 'id' => $model->id],[
            'data' => [
                'confirm' => Yii::t('app', 'Sei sicuro di voler cancellare questo spettacolo?'),
                'method' => 'post',
            ],
            'class' => 'btn btn-danger',
        ])  ?>
        <?= Html::a('<i class="fas fa-ticket"></i>', ['prenotazioni', 'spettacolo_id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </div>
    
    <?= $form->field($model, 'spettacolo')->textInput([
                'placeholder' => Yii::t('app', 'Spettacolo'),
                'class' => 'form form-control title'
            ])->label(false) ?>
    
    <?= $form->field($model, 'banner')->fileInput()
            ->label('<i class="fas fa-plus-circle"></i> '.Yii::t('app', 'Copertina'), [
                    'class' => 'btn btn-warning add-slide file-image banner b-image-cover b-image-norepeat b-image-center-center',
                    'style' => 'background-image: url('.$model->banner.')',
                ],
            ) ?>
    
    <div class="flex gap-1">
        <div class="">
            <?= $form->field($model, 'locandina')->fileInput()
                ->label('<i class="fas fa-plus-circle"></i> '. Yii::t('app', 'Locandina'), [
                        'class' => 'btn btn-warning add-slide file-image locandina b-image-cover b-image-norepeat b-image-center-center',
                        'style' => 'background-image: url('.$model->locandina.')',
                ]) ?>
        </div>
        
        <div class="w-100">
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
            
            <?= $form->field($model, 'sinossi')->widget(TinyMce::className(), [
                'options' => ['rows' => 10],
                'language' => 'es',
                'clientOptions' => [
                    'plugins' => [
                        "advlist autolink lists link charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste"
                    ],
                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                ]
            ]);?>
        </div>
    </div>
    
    
    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/ilove-form.css');