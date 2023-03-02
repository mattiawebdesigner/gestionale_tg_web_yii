<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VerbaliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ($type == "create") ? Yii::t('app', 'Nuova categoria') : Yii::t('app', 'Modifica categoria: {categoria}', [
    'categoria' => $category->categoria,
]);
?>
<div class="verbali-index sanlorenzo-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="action-bar">
            <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva e chiudi'), ['class' => 'btn btn-success']) ?>
            
            <?php if($type=="update") : ?>
            <span class="btn btn-danger">
                <?= Html::a('<i class="fas fa-trash-alt"></i> '.Yii::t('app', 'Cancella'), ['/sanlorenzo/categorie-delete', 'id' => $category->id],[
                    'data' => [
                        'confirm' => Yii::t('app', 'Sei sicuro di voler cancellare questa categoria?'),
                        'method' => 'post',
                    ],
                ])  ?>
            </span>
            <?php endif; ?>
            
            <span class="btn btn-danger">
                <?= Html::a('<i class="fas fa-times"></i> '.Yii::t('app', 'Chiudi'), ['/sanlorenzo/categorie-articoli'])  ?>
            </span>
        </div>

        <?= $form->field($category, 'categoria')->textarea([
            'placeholder'   => Yii::t('app', 'Aggiungi una categoria'),
            'autofocus'     => 'autofocus',
            'class'         => 'form-control title',
            'maxlength'     => true 
        ])->label(false) ?>

        <?= $form->field($category, 'categoria_padre')->dropDownList(
            yii\helpers\ArrayHelper::map(backend\models\SnlCategorie::find()->all(), 'id', 'categoria'),
            ['prompt' => '--']
        ) ?>
    
    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerCssFile('@web/css/sanlorenzo/sanlorenzo-form.css', ['depends' => \yii\bootstrap4\BootstrapAsset::class]);