<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Iscritti al festival');
?>
<div id="iloveteatro-iscrizioni">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model,
        'festival'  => $festival,
        'pdf'       => $pdf,
    ]) ?>
</div>