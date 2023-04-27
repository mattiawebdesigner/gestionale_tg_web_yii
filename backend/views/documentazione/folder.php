<?php
use yii\helpers\Html;

$this->title = Yii::t('app', $cartella_obj->categoria);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentazione'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><i class="fa-solid fa-folder"></i> <?= Html::encode($this->title) ?></h1>

<?= $this->render("_actions", [
    'id' => $id,
]) ?>


<div id="document-container">

    <h4><?= Yii::t('app', 'Files') ?></h4>
    <?php if(sizeof($documenti) > 0) : ?>
    <div class="files">
        <?php foreach($documenti as $k => $cartella) : ?>
        <div class="file">
            <a href="">
                <div class="icon">
                    <i class="fa-solid fa-file"></i>
                </div>

                <div class="name">
                    <?= $cartella->fileName ?>
                </div>
            </a>
            
            <div class="actions">
                    <div class="point">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    
                    <div class="menu">
                        <div class="content ">
                            <div class="trash">
                                <i class="fa-solid fa-trash-can"></i> 
                                <?= Html::a(Yii::t('app', 'Cancella il file'), ['delete-file', 'id' => $cartella->id, 'cartella_id' => $cartella_obj->id]) ?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
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
$this->registerJsFile("@web/js/documentazione.js",['depends' => yii\web\JqueryAsset::class]);