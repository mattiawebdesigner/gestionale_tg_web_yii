<?php 
use yii\helpers\Url;

?>
<div class="col-lg-4">
    <h2><i class="fas fa-scroll"></i> <?= Yii::t('app', 'Convocazioni e verbali') ?></h2>

    <p><?= Yii::t('app', 'Visualizza le convocazioni e i verbali, suddivisi per anno') ?></p>
    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/verbali/index-socio']) ?>"><?= Yii::t('app', 'Visualizza') ?></a></p>
</div>