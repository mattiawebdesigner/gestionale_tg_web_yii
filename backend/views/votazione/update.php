<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VociSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aggiorna votazione {anno}', [
    'anno' => $votazione->anno,
]);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="votazione-update">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form', [
        'votazione' => $votazione,
        'type'      => "update",
    ]) ?>
    
</div>