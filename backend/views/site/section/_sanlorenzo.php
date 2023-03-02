<?php
use yii\helpers\Url;
?>
<div class="col-lg-4">
    <h2><i class="fas fa-star"></i> <?= Yii::t('app', 'La Notte di San Lorenzo') ?></h2>

    <p><?= Yii::t('app', 'Amministra La Notte di San Lorenzo') ?></p>

    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/sanlorenzo/index']) ?>"><?= Yii::t('app', 'Amministra') ?></a></p>
</div>