<?php
use yii\helpers\Url;

$this->title = Yii::t('app', 'Categorie per gli articoli');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tgsite-index">
    <div class="body-content">
        <h1><?= $this->title ?></h1>
    </div>
</div>

<?php
$this->registerCssFile("@web/css/tg-site/style.css");
