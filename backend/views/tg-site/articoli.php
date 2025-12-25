<?php
$this->title = Yii::t('app', 'Articoli');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestione sito'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tgsite-categories">
    <div class="body-content">
        <h1><?= $this->title ?></h1>
    </div>
    
    
</div>

<?php
$this->registerCssFile("@web/css/tg-site/style.css");