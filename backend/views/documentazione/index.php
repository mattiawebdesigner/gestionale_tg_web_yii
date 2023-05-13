<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentazioneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documentazione');
$this->params['breadcrumbs'][] = $this->title;
$id = 1;
//Flag per valutare se si sta visualizzando la index
//di amministrazione o del socio
$socio = $socio ?? false;
?>
<div class="documentazione-index">
    <h1><i class="fa-solid fa-folder"></i> <?= Html::encode($this->title) ?></h1>
    
    <?php if(!$socio) : ?>
        <?= $this->render("_actions", [
            'id' => $id,
        ]) ?>
    
        <div data-action="create-folder" class="btn btn-success">
            <i class="fa-solid fa-plus"></i> <?= Yii::t('app', 'Nuova cartella') ?>
        </div>
    <?php endif; ?>
    <p></p>
    
    <div id="document-container">
        <div class="folders">
        <?php foreach($cartelle as $k => $cartella) : ?>
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
        
        <?php //Visualizzo eventuali file non categorizzati ?>
        
        <h4><?= Yii::t('app', 'Files') ?></h4>
        <div class="files">
            <?php foreach($documenti as $k => $documento) : ?>
            <div class="file">
                <a href="?r=documentazione/view&id=<?= $documento->id ?>&cartellaId=<?= $id ?>">
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
                                    <?= Html::a(Yii::t('app', 'Cancella il file'), ['delete-file', 'id' => $documento->id]) ?>
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
    </div>
</div>

<div id="new-folder">
    <div>
        
        <div data-close>
            <i class="fa-solid fa-circle-xmark"></i>
        </div>

        <input type="text" class="form form-control" placeholder="<?= Yii::t('app', 'Nome della cartella') ?>" data-name />
        <div class="btn btn-success" data-save="folder">
            <i class="fa-solid fa-floppy-disk"></i> <?= Yii::t('app', 'Crea cartella') ?>
        </div>
    </div>
</div>
    

<?php
$this->registerCssFile("@web/css/documentazione.css",['depends' => yii\bootstrap4\BootstrapAsset::class]);
$this->registerJsFile("@web/js/documentazione.js",['depends' => yii\web\JqueryAsset::class]);
$this->registerJs(<<<JS
jQuery("[data-save='folder']").click((e)=>{
    var nomeCartella = jQuery(" [data-name]", jQuery(e.currentTarget).parent()).val();
    $.ajax({
        type 	:'POST',
        url  :'?r=documentazione/create-folder',
        data: { 'nomeCartellla': nomeCartella },
        success  : function(response) {
            if(response){
                location.reload();
            }else{
                alert("Errore nella creazione della cartella");
            }
        },
        error: function(){
            alert("Errore nella creazione della cartella");
        }
    });
});
jQuery("[data-action='create-folder']").click((e)=>{
    jQuery("#new-folder").css("display", "flex");
});
jQuery("[data-close]").click((e)=>{
    jQuery(e.currentTarget).parent().parent().hide();
});
JS);