<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentazioneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documentazione');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentazione-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render("_actions", [
        'id' => 1,
    ]) ?>
    
    <div id="document-container">
        <div class="folders">
        <?php foreach($cartelle as $k => $cartella) : ?>
            <a href="?r=documentazione/folder&id=<?= $cartella->id ?>">
                <div class="folder">
                    <div class="icon">
                        <i class="fa-solid fa-folder"></i>
                    </div>

                    <div class="name">
                        <?= $cartella->categoria ?>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        
        <?php //Visualizzo eventuali file non categorizzati ?>
        
        <h4><?= Yii::t('app', 'File') ?></h4>
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
    </div>
</div>
    

<?php
$this->registerCssFile("@web/css/documentazione.css",['depends' => yii\bootstrap4\BootstrapAsset::class]);
