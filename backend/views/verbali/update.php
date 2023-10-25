<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Verbali */

$this->title = Yii::t('app', 'Aggiornamento verbale: {name}', [
    'name' => $model->numero_protocollo,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Verbali'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Prot.: ".$model->numero_protocollo, 'url' => ['view', 'numero_protocollo' => $model->numero_protocollo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="verbali-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form', [
        'model'     => $model,
        'allegati'  => $allegati,
        'firme'     => $firme,
    ]) ?>
    <h4><?= Yii::t('app', 'Allegati') ?></h4>
    
    <?php if($allegatiReal == null) : ?>
        <div class="alert alert-info"><?= Yii::t('app', 'Non ci sono allegati per questo verbale'); ?></div>
    <?php else : ?>
        <ul>
        <?php foreach($allegatiReal as $key => $value) : ?>
            <li><a href="<?= $value->allegato ?>"> <?= $value->nome_originale    ?></a></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</div>
