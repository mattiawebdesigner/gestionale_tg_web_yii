<?php
use yii\helpers\Html;
?>
<p>
    <?= Html::a('<i class="fa-solid fa-arrow-up-from-bracket"></i> '.Yii::t('app', 'Carica un documento'), ['upload', 'id' => $id], ['class' => 'btn btn-success']) ?>
</p>