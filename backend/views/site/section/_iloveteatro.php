<?php
use yii\helpers\Url;
?>
<div class="col-lg-4">
    <h2><i class="fas fa-heartbeat"></i> <?= Yii::t('app', 'I Love Teatro') ?></h2>

    <p><?= Yii::t('app', 'Amministra I Love Teatro') ?></p>

    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/iloveteatro/index']) ?>"><?= Yii::t('app', 'Amministra') ?></a></p>
</div>