<?php 
use yii\helpers\Url;

?>
<div class="col-lg-4">
    <h2><i class="far fa-file"></i> <?= Yii::t('app', 'Gestione documenti') ?></h2>

    <p><?= Yii::t('app', 'Gestisci i documenti, decidendo quali possono essere visualizzati dai soci nella loro sezione dedicata') ?></p>
    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/documentazione/index']) ?>"><?= Yii::t('app', 'La documentazione') ?></a></p>
</div>