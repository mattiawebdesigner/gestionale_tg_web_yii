<?php
use yii\helpers\Html;
?>
<?= Html::a('<i class="fas fa-sign-out-alt"></i> '.Yii::t('app', 'Rifiuta iscrizione'), 
        ['iscrizioni-delete', 'id' => $model->id], 
        ['class' => 'btn btn-danger']) ?>