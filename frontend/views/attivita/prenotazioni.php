<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Prenotazioni;

/* @var $this yii\web\View */
/* @var $prenotazioni backend\models\Attivita */
/* @var $prenotazioni backend\models\Prenotazioni */

$this->title = $prenotazioni->email ?? Yii::t('app', 'Nessuna prenotazione');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attivita'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

if(isset($attivita->parametri)){
$n_of_turns = sizeof((array)$attivita->parametri->dates->days)+1;
}
?>
<div id="next" class="attivita-view">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if(!isset($attivita)) : ?>
        <p class="alert alert-info"><?= Yii::t('app', "Non ci sono prenotazioni con questa email")?>
    <?php else : ?>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                        <div class="img" style="background-image: url(<?= "../../backend/web/".$attivita->foto ?: "" ?>)"></div>
                </div>

                <div class="content">
                    <strong><?= Yii::t('app', 'Turno prenotato'); ?>: <?= $turno ?></strong>
                    <div class="place"><i class="fas fa-map-pin"></i> <?= $attivita->luogo ?></div>
                    <?php
                    echo $this->render('sections/_singleDate',[
                        'attivita'        => $attivita,
                        'turn'            => $turno,
                    ]);
                    echo $this->render('sections/_singlePlace',[
                        'attivita'        => $attivita,
                        'turn'            => $turno,
                    ]);
                    echo $this->render('sections/_singlePrice',[
                        'attivita'        => $attivita,
                        'turn'            => $turno,
                    ]);
                    ?>

                    <p></p>

                    <div class="actions">
                        <?= Html::a('<i class="fas fa-pen"></i> '.Yii::t('app', 'Update'), ['update', 'id' => $attivita->id, 'email' => $prenotazioni->email, 'turn' => $turno], ['class' => 'btn-update btn btn-primary btn-sm']) ?>
                        <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $attivita->id, 'email' => $prenotazioni->email, 'turn' => $turno], [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]) ?>

                    </div>
                </div>

                <?php $form = ActiveForm::begin(['options' => ['class'=>'display-none']]);

                //Corregge il valore del turno per il suo corretto utilizzo
                //Se si tratta del primo turno la differenza $turn-2 darebbe -1 e non è valido,
                //quindi correggo riportando il suo valore a 1.
                //Se si tratta dei turni dal 2 in poi (registrati nel campo JSON parametri
                //sul database) allora effettuo il calcolo della diferrenza $turn-2
                $turnCorrect = (($turno-2)===-1)?1:$turno-2; ?>
                    <?= $form->field($prenotazioni, 'prenotazioni')
                                ->textInput(['type'=>'number', 
                                    'min' => 1,
                                    'max' => ($n_of_turns==1)?
                                                ($attivita->posti_disponibili-$posti_occupati) :
                                                ($attivita->parametri->dates->days[$turnCorrect]->place - Prenotazioni::find()->where(['attivita_id' => $attivita->id, 'turno' => $turno])->sum('prenotazioni'))
                                    ])
                                ->label(Yii::t('app', 'Numero di partecipanti')) ?>
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
        </div>
    <?php endif; ?>
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
























