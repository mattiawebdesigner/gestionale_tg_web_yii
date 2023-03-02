 <?php 
 use yii\helpers\Url;

?>
<div class="col-lg-4">
    <h2><i class="fas fa-coins"></i> <?= Yii::t('app', 'Rendiconti') ?></h2>

    <p><?= Yii::t('app', 'Gestisci le rendicontazioni') ?></p>

    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/rendiconto/index']) ?>"><?= Yii::t('app', 'I rendiconti') ?></a></p>
</div>