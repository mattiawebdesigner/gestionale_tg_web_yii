 <?php 
 use yii\helpers\Url;

?>
<div class="col-lg-4">
    <h2><i class="fas fa-warehouse"></i> <?= Yii::t('app', 'Visualizza il materiale') ?></h2>

    <p><?= Yii::t('app', 'Visualizza tutto il materiale della compagnia!') ?></p>

    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/prodotto/index-socio']) ?>"><?= Yii::t('app', 'Visualizza') ?></a></p>
</div>