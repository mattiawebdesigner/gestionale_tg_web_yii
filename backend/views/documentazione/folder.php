<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Cartella');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentazione'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render("_actions", [
    'id' => $id,
]) ?>


<div id="document-container">

    <h4><?= Yii::t('app', 'Files') ?></h4>
    <?php if(sizeof($documenti) > 0) : ?>
    <div class="files">
        <?php foreach($documenti as $k => $cartella) : ?>

        <a href="">
            <div class="file">
                <div class="icon">
                    <i class="fa-solid fa-file"></i>
                </div>

                <div class="name">
                    <?= $cartella->fileName ?>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p class="alert alert-info">
        <?= Yii::t('app', 'Non ci sono file in questa cartella') ?>
    </p>
    <?php endif; ?>
    
</div>

<?php
$this->registerCssFile("@web/css/documentazione.css",['depends' => yii\bootstrap4\BootstrapAsset::class]);
