<?php
use backend\models\IltIscrizioni;
?>

<?php if($model->attivo === IltIscrizioni::DELETED): ?> 
    <?= $this->render('btns/_approved', ['model' => $model]) ?>
<?php elseif($model->attivo === IltIscrizioni::SUBSCRIBED): ?>
    <?= $this->render('btns/_delete', ['model' => $model]) ?>
<?php else : ?>
    <?= $this->render('btns/_approved', ['model' => $model]) ?>
    <?= $this->render('btns/_delete', ['model' => $model]) ?>
<?php endif; ?>
