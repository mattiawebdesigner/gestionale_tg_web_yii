<?php
use yii\helpers\Url;

$this->title = Yii::t('app', 'Gestione del sito');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tgsite-index">
    <div class="body-content">
        <h1><?= Yii::t('app', 'Amministrazione del sito') ?></h1>
        
        <div class="flex flex-row flex-wrap">
            
            <div class="col-lg-4">
                <h2><i class="fa-solid fa-bars"></i> <?= Yii::t('app', 'Menu') ?></h2>

                <p><?= Yii::t('app', 'Definisci il menu di navigazione per il sito') ?></p>

                <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/tg-site/menu']) ?>"><?= Yii::t('app', 'Vai') ?></a></p>
            </div>
            
            <div class="col-lg-4">
                <h2><i class="fa-regular fa-pen-to-square"></i> <?= Yii::t('app', 'Articoli') ?></h2>

                <p><?= Yii::t('app', 'Crea nuovi articoli per il sito o modifica quelli già esistenti') ?></p>

                <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/tg-site/articoli']) ?>"><?= Yii::t('app', 'Tutti gli articoli') ?></a></p>
            </div>
            
            <div class="col-lg-4">
                <h2><i class="fa-solid fa-list"></i> <?= Yii::t('app', 'Categorie') ?></h2>

                <p><?= Yii::t('app', 'Aggiungi o modifica le categorie') ?></p>

                <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/tg-site/categorie']) ?>"><?= Yii::t('app', 'Gestisci') ?></a></p>
            </div>
            
            <div class="col-lg-4">
                <h2><i class="fa-solid fa-images"></i> <?= Yii::t('app', 'Galleria fotografica') ?></h2>

                <p><?= Yii::t('app', 'Organizza le foto in album e pubblicale nel sito.') ?></p>

                <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/tg-site/album']) ?>"><?= Yii::t('app', 'Gestisci') ?></a></p>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerCssFile("@web/css/tg-site/style.css");