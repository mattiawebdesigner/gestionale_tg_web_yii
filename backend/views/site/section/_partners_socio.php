 <?php 
 use yii\helpers\Url;

?>
<div class="col-lg-4">
    <h2><i class="far fa-handshake"></i> <?= Yii::t('app', 'I soci') ?></h2>

    <p><?= Yii::t('app', 'Visualizza tutti i soci') ?></p>

    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/soci/index-socio']) ?>"><?= Yii::t('app', 'I Soci') ?></a></p>
</div>