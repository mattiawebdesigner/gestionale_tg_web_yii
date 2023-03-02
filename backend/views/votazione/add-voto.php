<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VociSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aggiungi un voto per la votazione del {anno}', [
    'anno' => $votazione->anno,
]);
$this->params['breadcrumbs'][] = $this->title;

$info = json_decode($votazione->info);
?>
<div class="votazione-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a(Yii::t('app', '<i class="fa-solid fa-chart-gantt"></i> Torna alla votazione'), ['view', 'id' => $votazione->id], ['class' => 'btn btn-warning']) ?>
    </p>
    
    <div class="anno">
        <i class="fa-solid fa-calendar-days"></i> <?= $votazione->anno ?>
    </div>

    <div class="luogo">
        <i class="fa-solid fa-location-dot"></i> <?= $votazione->luogo ?>
    </div>
    
    <?php foreach ($info as $k => $i) : ?>
    <div class="data flex gap-1">
        <div>
            <i class="fa-solid fa-calendar-days"></i> <?= $i->data ?>
        </div>
        <div>
            <i class="fa-solid fa-hourglass-start"></i> <?= $i->ora_inizio ?>
        </div>
        <div>
            <i class="fa-solid fa-hourglass-end"></i> <?= $i->ora_fine ?>
        </div>
    </div>
    <?php endforeach; ?>
    
    <p></p>
    
    <?php $form = ActiveForm::begin(); ?>
        
        <?php foreach ($soci as $k => $v) : ?>
            <div><strong><?= $v['cognome']." ".$v['nome'] ?></strong></div>
            <div class="flex">
                <?= $form->field($voto, 'n_scheda[]')->textInput(['required']) ?>
                <?= $form->field($voto, 'id_socio[]')->textInput(['type' => 'hidden', 'value' => $v['id']])->label(false) ?>
            </div>
        <?php endforeach; ?>
        
        <div class="form-group">
            <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva votazione'), ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
    
</div>