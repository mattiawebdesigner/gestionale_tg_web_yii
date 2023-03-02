 <?php 
 use yii\helpers\Url;

 ?>			
<div class="col-lg-4">
    <h2><i class="fas fa-users"></i> <?= Yii::t('app', 'Gestione utenti') ?></h2>

    <p><?= Yii::t('app', 'Gestisci gli utenti in grado di amministrare il gestionale') ?></p>
    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/utenti/index']) ?>"><?= Yii::t('app', 'Gli utenti') ?></a></p>
</div>