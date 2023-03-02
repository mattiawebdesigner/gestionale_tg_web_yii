<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);

$event = backend\models\SnlEdizione::findOne(['anno' => date('Y')]);
$contest_id = ($event<>null) ? \backend\models\SnlContest::findOne($event->contest)->id : null;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="Content-Type" content="text/html; charset='<?php echo Yii::$app->charset ?>'" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <?php $this->registerCssFile('@web/css/sanlorenzo/style.css', ['depends' => \yii\bootstrap4\BootstrapAsset::class]); ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

    <header>
        <?php

        NavBar::begin([
            'options' => [
                'id' => 'mainmenu',
                'class' => 'navbar navbar-expand-md ',
            ],
        ]);


        $menuItems[] = ['label' => Html::img(Yii::$app->params['logo_sanlorenzo']), 'url' => Yii::$app->params['backendSanLorenzo'], ['options' => 'cursor-none']];
        $menuItems[] = ['label' => '<i class="fas fa-external-link-alt"></i> San Lorenzo', 'url' => '/lanottedisanlorenzo/', 'linkOptions' => array(
                         'target' => '_blank'
        )];
        $menuItems[] = ['label' => '<i class="far fa-building"></i> <span>'.Yii::t('app', 'Bacheca').'</span>', 'url' => ['/sanlorenzo/index']];
        $menuItems[] = [
            'label' => '<i class="far fa-newspaper"></i> <span>'.Yii::t('app', 'Articoli').'</span>', 
            'url' => ['sanlorenzo/articoli'], 
            'items' => [
                ['label' => '<i class="fas fa-plus-circle"></i> '.Yii::t('app', 'Nuovo articolo'), 'url' => ['/sanlorenzo/nuovo-articolo']],
                ['label' => '<i class="far fa-eye"></i> '.Yii::t('app', 'Tutti gli articoli'), 'url' => ['/sanlorenzo/all-articles']],
                ['label' => '<i class="fas fa-ruler-vertical"></i> '.Yii::t('app', 'Categorie'), 'url' => ['/sanlorenzo/categorie-articoli']],
            ]
        ];
        $menuItems[] = [
            'label' => '<i class="fas fa-star"></i> <span>'.Yii::t('app', 'L\'evento').'</span>', 
            'url' => '#',
            'items' => [
                ['label' => '<i class="far fa-eye"></i> '.Yii::t('app', 'Le edizioni'), 'url' => ['/sanlorenzo/show-events']],
                ['label' => '<i class="fas fa-plus-circle"></i> '.Yii::t('app', 'Nuova edizione'), 'url' => ['/sanlorenzo/create-event']],
                '<hr />',
                ['label' => '<i class="fas fa-plus-circle"></i> '.Yii::t('app', 'Nuovo contest'), 'url' => ['/sanlorenzo/create-contest']],
                ['label' => '<i class="far fa-eye"></i> '.Yii::t('app', 'Il contest'), 'url' => ['/sanlorenzo/view-contest', 'id' => $contest_id]],
                '<hr />', 
                ['label' => '<i class="far fa-eye"></i> '.Yii::t('app', 'Iscritti'), 'url' => ['/sanlorenzo/subscribers']],
                '<hr />', 
                ['label' => '<i class="fa-solid fa-handshake"></i> '.Yii::t('app', 'I Partner'), 'url' => ['/sanlorenzo/partner-index']],
                '<hr />', 
                ['label' => '<i class="fa-solid fa-gavel"></i> '.Yii::t('app', 'I Giudici'), 'url' => ['/sanlorenzo/giudici-index']],
                '<hr />', 
                ['label' => '<i class="fa-solid fa-palette"></i> '.Yii::t('app', 'Gli artisti'), 'url' => ['/sanlorenzo/artisti-index']],
                '<hr />', 
                ['label' => '<i class="fa-solid fa-burger"></i> '.Yii::t('app', 'Stand alimentari'), 'url' => ['/sanlorenzo/stand-index']],
            ]
        ];
        $menuItems[] = ['label' => '<i class="fas fa-comments"></i> <span>'.Yii::t('app', 'Commenti').'</span>', 'url' => ['sanlorenzo/commenti']];
        $menuItems[] = ['label' => '<i class="fa-solid fa-images"></i> <span>'.Yii::t('app', 'Gallerie fotografiche').'</span>', 'url' => '#', 'items' => [
            ['label' => '<i class="far fa-eye"></i> '.Yii::t('app', 'Le gallerie fotografiche'), 'url' => ['/gallery/index', 'l' => 'sanlorenzo']],
            ['label' => '<i class="fas fa-plus-circle"></i> '.Yii::t('app', 'Nuova galleria fotografica'), 'url' => ['/gallery/create', 'l' => 'sanlorenzo']],
        ]];
        $menuItems[] = ['label' => '<i class="fa-solid fa-gear"></i> <span>'.Yii::t('app', 'Impostazioni').'</span>', 'url' => ['sanlorenzo/settings']];
        ?>

        <?php
        echo Nav::widget([
            'encodeLabels' => false,
            'options' => ['class' => 'navbar-nav'],
            'items' => $menuItems,
        ]);
        NavBar::end();?>

        <?php
        $this->registerJs('
            jQuery("#mainmenu .active").parents("div").show();
        ');
        ?>
    </header>

    <main role="main" class="flex-shrink-0 p-relative o-auto">
        <header>
        </header>
        
        <div class="container">

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); 