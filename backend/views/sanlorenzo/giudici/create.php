<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Nominativo */

$this->title = Yii::t('app', 'Aggiunta nuovo giurato');
?>
<div id="imgs" class="nominativo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'type'  => 'create',
    ]) ?>

</div>
