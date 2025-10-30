<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Prenotazioni;

/* @var $this yii\web\View */
/* @var $prenotazioni backend\models\Attivita */
/* @var $prenotazioni backend\models\Prenotazioni */

$this->title = $prenotazioni->email ?? Yii::t('app', 'Nessuna prenotazione');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attivita'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Prenotazione');
\yii\web\YiiAsset::register($this);

?>
<div id="next" class="attivita-view">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if(!isset($prenotazioni)) : ?>
        <p class="alert alert-info"><?= Yii::t('app', "Non ci sono prenotazioni con questa email")?>
        
        <p>
            <?= Yii::t('app' , 'Torna alla pagina di prenotazione cliccando ') ?>
            <?= Html::a('qui', ['attivita/info','id'=>$attivita->id, 'turn'=>$turnCorrect]) ?>
        </p>
    <?php else : ?>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                        <div class="img" style="background-image: url(<?= "../../backend/web/".$attivita->foto ?: "" ?>)"></div>
                </div>

                <div class="content">
                    <strong><?= Yii::t('app', 'Turno prenotato'); ?>: <?= $turno + 1 ?></strong>
                    <div class="place"><i class="fas fa-map-pin"></i> <?= $attivita->luogo ?></div>
                    <?php
                    echo $this->render('sections/_singleDate',[
                        'attivita'      => $attivita,
                        'turnCorrect'   => $turnCorrect,
                    ]);
                    echo $this->render('sections/_freePlace',[
                        'model'         => $attivita,
                        'turnCorrect'   => $turnCorrect,
                        'posti_occupati'=> $posti_occupati,
                    ]);
                    echo $this->render('sections/_singlePrice',[
                        'attivita'      => $attivita,
                        'turnCorrect'   => $turnCorrect,
                    ]);
                    ?>

                    <p></p>

                    <div class="actions">
                        <?= Html::a('<i class="fas fa-pen"></i> '.Yii::t('app', 'Update'), '#', ['class' => 'btn-update btn btn-primary btn-sm']) ?>
                        <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $attivita->id, 'email' => $prenotazioni->email, 'turn' => $turno], [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]) ?>

                    </div>
                </div>

                <?php $form = ActiveForm::begin(['options' => ['class'=>'display-none']]);?>
                    <?= $form->field($prenotazioni, 'prenotazioni')
                                ->textInput(['type'=>'number', 
                                    'min' => 1,
                                    'max' => ($attivita->parametri->dates->days[$turnCorrect]->place - Prenotazioni::find()->where(['attivita_id' => $attivita->id, 'turno' => $turno])->andWhere(["<>", "email", $prenotazioni->email])->sum('prenotazioni'))
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
























