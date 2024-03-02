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

    <?php $this->registerCssFile('@web/css/iloveteatro/style.css', ['depends' => \yii\bootstrap4\BootstrapAsset::class]); ?>
    <?php $this->registerJsFile('@web/js/iloveteatro/menu.js', ['depends' => \yii\web\JqueryAsset::class]); ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<div class="d-flex min-height-100p height-auto o-hidden">
<header>
    <div class="show-mobile-menu">
        <i class="fa-solid fa-bars"></i>
        <?= Html::img(Yii::$app->params['pittogramma_iloveteatro'], ['class' => 'pittogramma']); ?>
    </div>
        <?php
        
        NavBar::begin([
            'options' => [
                'id' => 'mainmenu',
                'class' => 'navbar navbar-expand-md navbar-iloveteatro bg-iloveteatro',
            ],
        ]);


        $menuItems[] = ['label' => Html::img(Yii::$app->params['logo_iloveteatro']), 'url' => '#', 'options'=>['class'=>'logo']];
        //$menuItems[] = ['label' => Html::img(Yii::$app->params['pittogramma_iloveteatro']), 'url' => '#', 'options'=>['class'=>'pittogramma']];
        
        $menuItems[] = ['label' => '<i class="fas fa-external-link-alt"></i> <span>I Love Teatro</span>', 'url' => '/iloveteatro/', 'linkOptions' => array(
                         'target' => '_blank'
        )];
        
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login'],];
        } else {
            $menuItems[] = '<li class="profile dropdown nav-item">'
                //. '<div>'
                    . Html::a('<i class="fas fa-user"></i> <span>'.Yii::$app->user->identity->nome.'</span>', 
                                '#',
                                ['class' => 'dropdown-toggle nav-link', 'data-toggle' => 'dropdown']
                            )
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline dropdown-menu'])
                    . Html::a(Yii::t('app', 'Profilo'),
                                ['/utenti/profile', 'id' => Yii::$app->user->id],
                                ['class' => 'nav-link', 'target' => '_blank']
                            )
                    . Html::submitButton(
                        'Logout',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                //. '</div>'
            . '</li>';
        }
        $menuItems[] = ['label' => '<i class="far fa-building"></i> <span>'.Yii::t('app', 'Bacheca').'</span>', 'url' => ['/iloveteatro/index']];
        $menuItems[] = ['label' => '<i class="fa-solid fa-masks-theater"></i> <span>'.Yii::t('app', 'Programmazione spettacoli').'</span>', 'url' => ['/iloveteatro/programming']];
        $menuItems[] = ['label' => '<i class="fa-solid fa-ticket"></i> <span>'.Yii::t('app', 'Ticket').'</span>', 'url' => ['/iloveteatro/ticket']];
        $menuItems[] = [
            'label' => '<i class="far fa-newspaper"></i> <span>'.Yii::t('app', 'Articoli').'</span>', 
            'url' => ['iloveteatro/articoli'], 
            'items' => [
                ['label' => '<i class="fas fa-plus-circle"></i> '.Yii::t('app', 'Nuovo articolo'), 'url' => ['/iloveteatro/nuovo-articolo']],
                ['label' => '<i class="far fa-eye"></i> '.Yii::t('app', 'Tutti gli articoli'), 'url' => ['/iloveteatro/tutti-articoli']],
                ['label' => '<i class="fas fa-ruler-vertical"></i> '.Yii::t('app', 'Categorie'), 'url' => ['/iloveteatro/categorie-articoli']],
            ]
        ];
        $menuItems[] = [
            'label' => '<i class="fas fa-heartbeat"></i> <span>'.Yii::t('app', 'Festival').'</span>', 
            'url' => '#',
            'items' => [
                ['label' => '<i class="far fa-eye"></i> '.Yii::t('app', 'I festival'), 'url' => ['/iloveteatro/festival-table']],
                ['label' => '<i class="fas fa-plus-circle"></i> '.Yii::t('app', 'Nuovo festival'), 'url' => ['/iloveteatro/festival']],
                '<hr />',
                ['label' => '<i class="far fa-eye"></i> '.Yii::t('app', 'Iscritti'), 'url' => ['/iloveteatro/iscritti']],   
            ]
        ];
        $menuItems[] = ['label' => '<i class="fas fa-euro"></i> <span>'.Yii::t('app', 'Sponsor').'</span>', 'url' => ['iloveteatro/sponsor']];
        $menuItems[] = ['label' => '<i class="fas fa-users"></i> <span>'.Yii::t('app', 'Partner').'</span>', 'url' => ['iloveteatro/partner']];
        $menuItems[] = ['label' => '<i class="fas fa-images"></i> <span>'.Yii::t('app', 'Media').'</span>', 'url' => ['iloveteatro/media']];
        $menuItems[] = ['label' => '<i class="fas fa-comments"></i> <span>'.Yii::t('app', 'Commenti').'</span>', 'url' => ['iloveteatro/commenti']];
        $menuItems[] = ['label' => '<i class="fas fa-cog"></i> <span>'.Yii::t('app', 'Impostazioni').'</span>', 'url' => ['iloveteatro/settings']];
        $menuItems[] = ['label' => '<i class="fas fa-photo-video"></i> <span>'.Yii::t('app', 'Slideshow').'</span>', 'url' => ['iloveteatro/slideshow']];
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
        
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>

        <footer class="footer mt-auto py-3 text-muted">
            <div class="container">
                <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
                <p class="float-right"><?= Yii::powered() ?></p>
            </div>
        </footer>
    </main>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); 