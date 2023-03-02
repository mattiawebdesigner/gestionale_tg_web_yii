 <?php 
 use yii\helpers\Url;

?>
<div class="col-lg-4">
    <h2><i class="fas fa-project-diagram"></i> <?= Yii::t('app', 'Attivit&agrave;') ?></h2>

    <p><?= Yii::t('app', 'Organizza tutte le attivit&agrave; in un unico posto.') ?></p>

    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/attivita/index']) ?>"><?= Yii::t('app', 'Le attivit&agrave;') ?></a></p>
</div>