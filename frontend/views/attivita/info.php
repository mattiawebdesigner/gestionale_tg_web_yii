<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Attivita */

$this->title = $model->nome;
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div id="next" class="attivita-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="row">
		<div class="col">
			<div class="wrapper">
				<div class="img" style="background-image: url(<?= "../../backend/web/".$model->foto ?: "" ?>)"></div>
			</div>
			
			<div class="content">
                            <div class="place"><i class="fas fa-map-pin"></i> <?= $model->luogo ?></div>
                            
                            <?php
                            $model->parametri  = json_decode($model->parametri); 
                            $n_of_turns         = sizeof((array)$model->parametri->dates->days)+1;
        
                            echo $this->render('sections/_turns',[
                                'n_of_turns'    => $n_of_turns,
                                'evento'        => $model,
                            ]);
                            ?>
                            
			</div>
				
			<?php if( ($model->posti_disponibili-$posti_occupati) == 0 && $model->posti_disponibili!=null) : ?>
				<div class="alert alert-warning">
					<?= Yii::t('app', 'Non ci sono posti disponibili')?>
				</div>
			<?php endif; ?>
				
			<hr style="border-style: outline;border-width: 3px;border-color: #f0f0f0;" />
			
			<div class="reservation">
				<?php if($model->prenotazione == "yes"): ?>
					<h5><?= Yii::t('app', 'Prenota') ?></h5>
					
    				<?php $form = ActiveForm::begin(); ?>
                                        <?= $form->field($prenotazioni, 'cognome')->textInput(['maxlength' => true]) ?>
                                        <?= $form->field($prenotazioni, 'nome')->textInput(['maxlength' => true]) ?>
    					<?= $form->field($prenotazioni, 'email')->textInput(['type'=>'email', 'maxlength' => true]) ?>
    					<?= $form->field($prenotazioni, 'prenotazioni')->textInput(['type'=>'number', 'min' => 1, 'max' => ($model->posti_disponibili-$posti_occupati)])->label(Yii::t('app', 'Numero di partecipanti')) ?>
					<?= $form->field($prenotazioni, 'turno')->hiddenInput(['value'=>$turn])->label(false); ?>	
                                        <div class="form-group">
                                            <?= Html::submitButton(Yii::t('app', 'Prenota'), ['class' => 'btn btn-success']) ?>
                                        </div>
    				<?php ActiveForm::end(); ?>
					
                                <h5><?= Yii::t('app', 'Cerca una prenotazione') ?></h5>
    				<?php $form = ActiveForm::begin(); ?>
    					<input type="hidden" name="action" value="search" />
    					
    					<?= $form->field($prenotazioni, 'email')->textInput(['type'=>'email', 'maxlength' => true]) ?>
					<?= $form->field($prenotazioni, 'turno')->hiddenInput(['value'=>$turn])->label(false); ?>

                                        <div class="form-group">
                                            <?= Html::submitButton(Yii::t('app', 'Cerca'), ['class' => 'btn btn-success']) ?>
                                        </div>
    				<?php ActiveForm::end(); ?>
					
				<?php endif;?>
			</div>
			
			<div class="description">
				<h5><?= Yii::t('app', "Note sull'evento") ?></h5>
				
				<?= $model->descrizione ?>
			</div>
		</div>
	</div>

</div>

<?php
$this->registerCssFile("@web/css/next.css");