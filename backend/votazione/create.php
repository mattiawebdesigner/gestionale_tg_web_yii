<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VociSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Indici una nuova votazione');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="votazione-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form', [
        'votazione' => $votazione,
    ]) ?>
    
</div>