<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$title = Yii::t('app', 'QR Code');
?>
<h1><?= Html::encode($title) ?></h1>

<div id="qr">
    <div>
        <img class="qr" src="<?= $qrCode ?>" />
    </div>
    
    <div>
        <a href="<?= $qrCode ?>" download><?= Yii::t('app', 'Scarica il QR'); ?></a>
    </div>
</div>

<?php
$this->registerCssFile('@web/css/qr.css', ['depends' => \yii\bootstrap4\BootstrapAsset::class]);