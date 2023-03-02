<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Invia una email');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestione email'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    
    <p>In allestimento!</p>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>