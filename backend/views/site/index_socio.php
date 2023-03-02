<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><i class="fas fa-user-alt"></i> <?=Yii::t('app', 'Profilo del Socio'); ?></h1>
		
        <p class="lead"><?= Yii::$app->user->identity->nome ?> <?= Yii::$app->user->identity->cognome ?></p>
    </div>

    <div class="body-content">
        <div class="row">
			
            <?= $this->render('section/_documents') ?>
            
        </div>

    </div>
</div>

