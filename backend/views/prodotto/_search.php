<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProdottoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prodotto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'categoria_id') ?>

    <?= $form->field($model, 'descrizione') ?>

    <?= $form->field($model, 'quantita') ?>

    <?php // echo $form->field($model, 'data_inserimento') ?>

    <?php // echo $form->field($model, 'proprietario_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
