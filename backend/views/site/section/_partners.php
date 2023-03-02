 <?php 
 use yii\helpers\Url;

?>
<div class="col-lg-4">
    <h2><i class="far fa-handshake"></i> <?= Yii::t('app', 'Gestione dei soci') ?></h2>

    <p><?= Yii::t('app', 'Gestisci i soci della compagnia. Puoi inoltre associare ad ogni socio anche le attivit&agrave; alle quali ha partecipato') ?></p>

    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/soci/index']) ?>"><?= Yii::t('app', 'I Soci') ?></a></p>
</div>