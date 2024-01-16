 <?php 
 use yii\helpers\Url;

?>
<div class="col-lg-4">
    <h2><i class="fa-solid fa-qrcode"></i> <?= Yii::t('app', 'QR Code') ?></h2>

    <p><?= Yii::t('app', 'Genera il tuo QR Code') ?></p>

    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/qr/index']) ?>"><?= Yii::t('app', 'Genera') ?></a></p>
</div>