<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?=Yii::t('app', 'Un unico gestionale'); ?></h1>
		
        <p class="lead"><?= Yii::$app->user->identity->nome ?> <?= Yii::$app->user->identity->cognome ?></p>
    </div>

    <div class="body-content">

        <div class="row">
        
            <?= $this->render('section/_partners') ?>
           
           <?= $this->render('section/_wharehouse') ?>
           
           <?= $this->render('section/_roll_of_honor') ?>
           
        </div>

        <div class="row">
           
           <?= $this->render('section/_activity') ?>
           
           <?= $this->render('section/_documents') ?>
           
        </div>

    </div>
</div>
