<?php
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Gestionale');
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">
			<?php if(Yii::$app->user->can("Socio")) : ?>
				<i class="fas fa-user-alt"></i> <?=Yii::t('app', 'Profilo del Socio'); ?> 		
        	<?php endif; ?>
        	
        	<br />
        	<?=Yii::t('app', 'Un unico gestionale'); ?>       
        </h1>
		
        <p class="lead"><?= Yii::$app->user->identity->nome ?> <?= Yii::$app->user->identity->cognome ?></p>
    </div>

    <div class="body-content">
		<?php if(Yii::$app->user->can("Super User")) : ?>
    		<h3><?= Yii::t('app', 'Amministrazione') ?></h3> <hr />
    		<?= $this->render('_index_all') ?>
		<?php else : ?>

                    <?php if(Yii::$app->user->can("segreteria")) : ?>
                            <h3><?= Yii::t('app', 'Segreteria') ?></h3> <hr />
                            <?= $this->render('_index_segreteria') ?>
                    <?php endif; ?>

                    <?php if(Yii::$app->user->can("event manager")) : ?>
                            <h3><?= Yii::t('app', 'Gestione degli eventi') ?></h3> <hr />
                            <?= $this->render('_index_event') ?>
                    <?php endif; ?>

                    <?php if(Yii::$app->user->can("magazziniere")) : ?>
                            <h3><?= Yii::t('app', 'Gestione del magazzino') ?></h3> <hr />
                            <?= $this->render('_index_wharehouse') ?>
                    <?php endif; ?>

                    <?php if(Yii::$app->user->can("Albo")) : ?>
                            <h3><?= Yii::t('app', 'Gestione dell\'albo d\'oro') ?></h3> <hr />
                            <?= $this->render('_index_roll_of_honor') ?>
                    <?php endif; ?>

                    <?php if(Yii::$app->user->can("spettacoli")) : ?>
                            <h3><?= Yii::t('app', 'Gestione spettacoli') ?></h3> <hr />
                            <?= $this->render('_index_spettacoli') ?>
                    <?php endif; ?>
                            
                    <?php if(Yii::$app->user->can("I Love Teatro")) : ?>
                            <h3><?= Yii::t('app', 'I Love Teatro') ?></h3> <hr />
                            <?= $this->render('_index_iloveteatro') ?>
                    <?php endif; ?>
    		
		<?php endif; ?>
                            
                <?php //FUNCTIONS ?>
                    <h3><?= Yii::t('app', 'Funzioni') ?></h3> <hr />
                    <?= $this->render('_index_functions') ?>
                <?php //////////////////////////  ?>
                            
                <?php if(\backend\models\Utenti::findOne(Yii::$app->user->id)->socio_id <> 0) : ?>
                    <h3><?= Yii::t('app', 'Area del socio') ?></h3> <hr />
                    <?= $this->render('_index_socio') ?>
		<?php endif; ?>
		
    </div>
</div>
