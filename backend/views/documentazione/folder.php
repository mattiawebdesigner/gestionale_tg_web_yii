<?php
use yii\helpers\Html;

$this->title = Yii::t('app', $cartella_obj->categoria);

$socio = $socio ?? false;
?>
<h1><i class="fa-solid fa-folder"></i> <?= Html::encode($this->title) ?></h1>

<?php if(!$socio) : ?>
    <?= $this->render("_actions", [
        'id' => $id,
    ]) ?>
<?php endif; ?>

<?php if($bid == 1): ?>
    <?php if($socio): ?>
        <?= Html::a('<i class="fa-solid fa-arrow-left-long"></i> ' . Yii::t('app', 'Indietro'), ['documentazione/socio-view', 'socio' => $socio]) ?>
    <?php else: ?>
        <?= Html::a('<i class="fa-solid fa-arrow-left-long"></i> ' . Yii::t('app', 'Indietro'), ['documentazione/index', 'socio' => $socio]) ?>
    <?php endif; ?>
<?php else: ?>
    <?= Html::a('<i class="fa-solid fa-arrow-left-long"></i> ' . Yii::t('app', 'Indietro'), ['documentazione/folder', 'id' => $bid, 'socio' => $socio]) ?>
<?php endif; ?>


<div id="document-container">    
    <div class="folders">
        <?php foreach($sottoCartelle as $k => $cartella) : ?>
        <div class="folder">
            <a href="?r=documentazione/folder&id=<?= $cartella->id ?>&socio=<?= $socio ?>">
                <div class="icon">
                    <i class="fa-solid fa-folder"></i>
                </div>

                <div class="name">
                    <?= $cartella->categoria ?>
                </div>
            </a>

            <?php if(!$socio) : ?>
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
                                <?= Html::a(Yii::t('app', 'Cancella la cartella'), ['delete-folder', 'id' => $cartella->id]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    
    <h4><?= Yii::t('app', 'File') ?></h4>
    <?php if(sizeof($documenti) > 0) : ?>
    <div class="files">
        <?php foreach($documenti as $k => $documento) : ?>
        <div class="file">
            <a href="?r=documentazione/view&id=<?= $documento->id ?>&cartellaId=<?= $id ?>&socio=<?= $socio ?>">
                <div class="icon">
                    <i class="fa-solid fa-file"></i>
                </div>

                <div class="name">
                    <?= $documento->fileName ?>
                </div>
            </a>
            
            
            <?php if(!$socio) : ?>
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
                                <?= Html::a(Yii::t('app', 'Cancella il file'), ['delete-file', 'id' => $documento->id, 'cartella_id' => $cartella_obj->id]) ?>
                            </div>
                            <div class="download">
                                <i class="fa-solid fa-download"></i> 
                                <?= Html::a(Yii::t('app', 'Scarica il file'), $documento->link, ['download' => true]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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