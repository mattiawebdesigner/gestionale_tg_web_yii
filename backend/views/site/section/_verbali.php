 <?php 
 use yii\helpers\Url;

?>
<div class="col-lg-4">
    <h2><i class="fas fa-scroll"></i> <?= Yii::t('app', 'Gestione dei verbali') ?></h2>

    <p><?= Yii::t('app', 'Gestisci i tuoi verbali e convoca i soci!') ?></p>

    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/verbali/manage']) ?>"><?= Yii::t('app', 'Gestisci') ?></a></p>
</div>