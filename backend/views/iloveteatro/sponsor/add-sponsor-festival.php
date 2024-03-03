<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Aggiungi sponsor al festival');
?>
<div class="sponsor-add">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form_add-sponsor-festival', [
        'model'     => $model,
        'festival'  => $festival,
    ]) ?>
    
</div>