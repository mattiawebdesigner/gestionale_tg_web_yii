<?php 
use yii\helpers\Url;

?>
<div class="col-lg-4">
    <h2><i class="far fa-file"></i> <?= Yii::t('app', 'Trasparenza') ?></h2>

    <p><?= Yii::t('app', 'Visualizza le rendicontazioni') ?></p>
    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/rendiconto/socio-view']) ?>"><?= Yii::t('app', 'Visualizza') ?></a></p>
</div>