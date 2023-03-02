 <?php 
 use yii\helpers\Url;

?>
<div class="col-lg-4">
    <h2><i class="fas fa-warehouse"></i> <?= Yii::t('app', 'Gestione del magazzino') ?></h2>

    <p><?= Yii::t('app', 'Organizza tutto il materiale in un unico spazio, archiviandolo anche per proprietario e categoria!    ') ?></p>

    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/prodotto/index']) ?>"><?= Yii::t('app', 'Il magazzino') ?></a></p>
</div>