<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Nominativo */

$this->title = Yii::t('app', 'Nuovo Nominativo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Albo d\'Oro'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="imgs" class="nominativo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'          => $model,
        'upload'         => $upload,
        'attivita'       => $attivita,
        'searchAttivita' => $searchAttivita,
        'media'          => $media,
        'myAttivita'     => null, //Fixed: https://github.com/mattiawebdesigner/gestionale_tg_web_yii/issues/1
    ]) ?>

</div>
