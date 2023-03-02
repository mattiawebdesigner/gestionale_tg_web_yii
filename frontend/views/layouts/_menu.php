<?php
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

NavBar::begin([
    //'brandLabel' =>$appname,
    'brandLabel' => Html::img('@web/images/loghi/logo.png', ['alt'=>$appname])." Teatralmente Gioia",
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-lg navbar-light bg-light fixed-top',
        'id' => 'mainmenu',
    ],
    'innerContainerOptions' => ['class' => 'container-fluid'],
]);
$menuItems = [
    //['label' => 'Home', 'url' => ['/site/index']],
    ['label' => 'Contattaci', 'url' => ['/site/contact']],
    ['label' => 'Attivita', 'url' => ['/attivita/index'], 'items' => [
        ['label' => Yii::t('app', 'Attivita\' in programma'), 'url' => ['/attivita/next']],
        ['label' => Yii::t('app', 'Tutte le attivita'), 'url' => ['/attivita/index']],
    ]],
    ['label' => Yii::t('app', 'Album fotorafici'), 'url' => ['/gallery/index']],
    ['label' => Yii::t('app', 'Albo d\'Oro'), 'url' => ['/nominativo/index']],
];
/*
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
        . Html::submitButton(
            'Logout (' . Yii::$app->user->identity->email . ')',
            ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
}*/
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => $menuItems,
]);
NavBar::end();
?>