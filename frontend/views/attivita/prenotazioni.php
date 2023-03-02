<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $prenotazioni backend\models\Attivita */
/* @var $prenotazioni backend\models\Prenotazioni */

$this->title = $prenotazioni->email ?? Yii::t('app', 'Nessuna prenotazione');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attivita'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div id="next" class="attivita-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="row">
    	
    	<?php if(!isset($attivita)) : ?>
    		<p class="alert alert-info"><?= Yii::t('app', "Non ci sono prenotazioni con questa email")?>
    	<?php else : ?>
    	
		<div class="col">
			<div class="wrapper">
				<div class="img" style="background-image: url(<?= "../../backend/web/".$attivita->foto ?: "" ?>)"></div>
			</div>
			
			<div class="content">
				<div class="place"><i class="fas fa-map-pin"></i> <?= $attivita->luogo ?></div>
				<div class="date"><i class="fas fa-calendar-alt"></i> <?= $attivita->data_attivita ?></div>
				<?php if($attivita->pagamento == "yes") : ?>
				<div class="date"><i class="fas fa-euro-sign"></i> <?= $attivita->costo ?></div>
				<?php endif; ?>
				<div class="chair">
					<i class="fas fa-chair"></i> <?= $attivita->posti_disponibili == null ? "Nessuna limitazione" : $attivita->posti_disponibili-$posti_occupati ?>
				</div>
				
				<p></p>
				
				<div class="actions">
                    <?= Html::a('<i class="fas fa-pen"></i> '.Yii::t('app', 'Update'), '#', ['class' => 'btn-update btn btn-primary btn-sm']) ?>
                    <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $attivita->id, 'email' => $prenotazioni->email], [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                    
				</div>
			</div>
			
			<?php $form = ActiveForm::begin(['options' => ['class'=>'display-none']]); ?>
    					<?= $form->field($prenotazioni, 'prenotazioni')->textInput(['type'=>'number', 'min' => 1,'max' => ($prenotazioni->prenotazioni+$attivita->posti_disponibili-$posti_occupati)])->label(Yii::t('app', 'Numero di partecipanti')) ?>
    					<?= $form->field($prenotazioni, 'email')->hiddenInput(['maxlength' => true])->label(false) ?>
						
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'Aggiorna la prenotazione'), ['class' => 'btn btn-success btn-sm']) ?>
                        </div>
    				<?php ActiveForm::end(); ?>
			
			<hr style="border-style: outline;border-width: 3px;border-color: #f0f0f0;" />
			
			<div class="description">
				<h5><?= Yii::t('app', "Note sull'evento") ?></h5>
				
				<?= $attivita->descrizione ?>
			</div>
		</div>
		
    	<?php endif; ?>
	</div>
    
</div>

<?php
$this->registerCssFile("@web/css/next.css");
$this->registerJs("
    jQuery(document).ready(function(){
        jQuery('.btn-update').click(function(){
            jQuery('form').slideToggle();
        });
    });
");
























