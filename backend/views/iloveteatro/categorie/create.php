<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VerbaliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Nuova categoria   ');
?>
<div class="verbali-index ilove-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="action-bar">
            <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva e chiudi'), ['class' => 'btn btn-success']) ?>
            
            <?php if($type=="update") : ?>
            <span class="btn btn-danger">
                <?= Html::a('<i class="fas fa-trash-alt"></i> '.Yii::t('app', 'Cancella'), ['/iloveteatro/categorie-delete', 'id' => $model->id],[
                    'data' => [
                        'confirm' => Yii::t('app', 'Sei sicuro di voler cancellare questa categoria?'),
                        'method' => 'post',
                    ],
                ])  ?>
            </span>
            <?php endif; ?>
            
            <span class="btn btn-danger">
                <?= Html::a('<i class="fas fa-times"></i> '.Yii::t('app', 'Chiudi'), ['/iloveteatro/categorie-articoli'])  ?>
            </span>
        </div>

        <?= $form->field($model, 'categoria')->textarea([
            'placeholder'   => Yii::t('app', 'Aggiungi una categoria'),
            'autofocus'     => 'autofocus',
            'class'         => 'form-control title',
            'maxlength'     => true 
        ])->label(false) ?>

        <?= $form->field($model, 'categorie_padre')->dropDownList(
            yii\helpers\ArrayHelper::map(backend\models\IltCategorie::find()->all(), 'id', 'categoria'),
            ['prompt' => '--']
        ) ?>
    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/ilove-form.css', ['depends' => \yii\bootstrap4\BootstrapAsset::class]);