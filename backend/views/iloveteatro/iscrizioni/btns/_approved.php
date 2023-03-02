<?php
use yii\helpers\Html;
?>
<?= Html::a('<i class="fas fa-sign-in-alt"></i> '.Yii::t('app', 'Accetta iscrizione'), 
        ['approved-troupe', 'id' => $model->id], 
        ['class' => 'btn btn-success']) ?>