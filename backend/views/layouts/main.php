<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html as HtmlHelper;

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
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    
    NavBar::begin([
        'brandLabel' => HtmlHelper::img(Yii::$app->params['logo'])
                        ." "
                        .Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'id' => 'mainmenu',
            'class' => 'navbar navbar-expand-md fixed-top',
        ],
    ]);
    
    $menuItems[] = ['label' => '<i class="fas fa-external-link-alt"></i>', 'url' => '../../frontend/', 'linkOptions' => array(
                     'target' => '_blank'
    )];
    ?>
    
	<?php
	if(Yii::$app->user->can("Super User")){
            include_once '_navbar_all.php';
            $menuItems = array_merge($menuItems, $menuItemsAll);
        }
	if(Yii::$app->user->can("segreteria")){
            include_once '_navbar_segretaria.php';
            $menuItems = array_merge($menuItems, $menuItemsSegreteria);
        }
	if(Yii::$app->user->can("event manager")){
            include_once '_navbar_event_manager.php';
            $menuItems = array_merge($menuItems, $menuItemsEvent);
        }
	if(Yii::$app->user->can("magazziniere")){
            include_once '_navbar_wharehouse.php';
            $menuItems = array_merge($menuItems, $menuItemsWarehouse);
        }
	if(Yii::$app->user->can("albo")){
            include_once '_navbar_albo.php';
            $menuItems = array_merge($menuItems, $menuItemsAlbo);
        }
	if(\backend\models\Utenti::findOne(Yii::$app->user->id)->socio_id <> 0){
            include_once '_navbar_socio.php';
            $menuItems = array_merge($menuItems, $menuItemsSocio);
        }
        
        if(Yii::$app->user->can("magazziniere") || Yii::$app->user->can("Super User") || 
                Yii::$app->user->can("event manager")){
        }
        
        /*if(Yii::$app->user->can("Super User") || Yii::$app->user->can("segreteria")){
            $menuItems[] = ['label' => '<i class="fas fa-envelope"></i>', 'url' => ['/site/email'],];
        }*/
    ?>
    <?php
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login'],];
    } else {
        $menuItems[] = '<li class="profile dropdown nav-item">'
            . '<div>'
                . Html::a('<i class="fas fa-user"></i> '.Yii::$app->user->identity->nome, 
                            '#',
                            ['class' => 'dropdown-toggle nav-link', 'data-toggle' => 'dropdown']
                        )
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline dropdown-menu'])
                . Html::a(Yii::t('app', 'Profilo'), 
                            ['/utenti/profile', 'id' => Yii::$app->user->id],
                            ['class' => 'nav-link']
                        )
                . Html::submitButton(
                    'Logout',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
            . '</div>'
        . '</li>';
    }
    
    echo Nav::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
    ]);
    NavBar::end();?>
</header>
	
    
<main role="main" class="flex-shrink-0">
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
        <div class="float-left">
            <ul>
                <li>&copy; <?= date('Y') ?> &#8226; 
                    <?= HtmlHelper::a(Html::encode(Yii::$app->params['ragione sociale']), 
                                        Yii::$app->params['site_protocol'].Yii::$app->params['sito'], [
                                            'target' => '_blank'
                                        ]) ?>
                </li>
                <li>&nbsp;</li>
                <li>C.F.: <?= Yii::$app->params['cf'] ?></li>
                <li>C.F.: <?= Html::a(Yii::$app->params['cell'], 'tel: '.Yii::$app->params['cell']) ?></li>
                <li>Email: <?= Html::mailto(Yii::$app->params['email'], Yii::$app->params['email']) ?></li>
                <li>
                    <?= HtmlHelper::a('<i class="fab fa-facebook-f"></i>', Yii::$app->params['facebook'], ['target' => '_blank'] )?>
                    <?= HtmlHelper::a('<i class="fab fa-instagram"></i>', Yii::$app->params['instagram'], ['target' => '_blank'] )?>
                    <?= HtmlHelper::a('<i class="fab fa-twitter"></i>', Yii::$app->params['twitter'], ['target' => '_blank'] )?>
                    <?= HtmlHelper::a('<i class="fab fa-youtube"></i>', Yii::$app->params['youtube'], ['target' => '_blank'] )?>
                </li>
            </ul>
        </div>
        <div class="float-right">
            <ul>
                <li>
                    <?= Yii::t('app', 'Realizzato da') ?>:
                    <?= HtmlHelper::a("Mattia Web Designer", "https://www.mattiawebdesigner.com/", [
                        'target' => '_blank',
                    ]) ?>
                </li>
                <li>
                    <?= Yii::t('app', 'Versione: ') ?> <strong><?= Yii::$app->params['version'] ?></strong>
                </li>
            </ul>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
