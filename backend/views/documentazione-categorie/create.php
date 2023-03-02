<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DocumentazioneCategorie */

$this->title = Yii::t('app', 'Create Documentazione Categorie');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentazione Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentazione-categorie-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
