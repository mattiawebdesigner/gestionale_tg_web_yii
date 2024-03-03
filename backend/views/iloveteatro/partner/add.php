<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Nuovo partner');
?>
<div class="sponsor-add">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form', [
        'model'     => $model,
        'festival'  => $festival,
    ]) ?>
</div>