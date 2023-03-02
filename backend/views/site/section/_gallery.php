 <?php 
 use yii\helpers\Url;

?>
<div class="col-lg-4">
    <h2><i class="fas fa-photo-video"></i> <?= Yii::t('app', 'Gallerie') ?></h2>

    <p><?= Yii::t('app', 'Gestisci le gallery delle foto e dei video') ?></p>

    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/gallery/index']) ?>"><?= Yii::t('app', 'Gestisci') ?></a></p>
</div>