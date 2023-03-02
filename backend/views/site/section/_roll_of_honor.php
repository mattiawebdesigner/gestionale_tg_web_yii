 <?php 
 use yii\helpers\Url;

?>
<div class="col-lg-4">
    <h2><i class="far fa-registered"></i> <?= Yii::t('app', 'Albo d\'Oro') ?></h2>

    <p><?= Yii::t('app', 'Aggiungi tutti i membri presenti e passati cos&igrave; da poter creare un archivio storico!') ?></p>

    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/nominativo/index']) ?>"><?= Yii::t('app', 'Gestione dei soci') ?></a></p>
</div>