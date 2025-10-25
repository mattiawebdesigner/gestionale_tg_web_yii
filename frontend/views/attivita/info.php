<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Prenotazioni;

/* @var $this yii\web\View */
/* @var $model backend\models\Attivita */

$this->title = $model->nome;
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$model->parametri = json_decode($model->parametri);
$n_of_turns = sizeof((array)$model->parametri->dates->days)+1;
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

                <div>
                    <strong><?= Yii::t('app', 'Turno') ?>: </strong> <?= $turn ?>
                </div>

                <?php
                echo $this->render('sections/_singleDate', [
                    'attivita' => $model
                ]);
                echo $this->render('sections/_freePlace', [
                    'model'      => $model,
                    'n_of_turns' => $n_of_turns,
                    'turn'       => $turn,
                ]);
                echo $this->render('sections/_singlePrice', [
                    'attivita' => $model
                ]);
                ?>
            </div>

            <?php        
            echo $this->render('sections/_noMorePlace',[
                'model'             => $model,
                'posti_occupati'    => $posti_occupati,
                'turn'              => $turn,
                'n_of_turns'        => $n_of_turns,
            ]);
            ?>

            <hr style="border-style: outline;border-width: 3px;border-color: #f0f0f0;" />

            <div class="reservation">
                <?php if($model->prenotazione == "yes"): ?>
                    <h5><?= Yii::t('app', 'Prenota') ?></h5>

                    <?php
                        $form = ActiveForm::begin(); 
                        
                        //Corregge il valore del turno per il suo corretto utilizzo
                        //Se si tratta del primo turno la differenza $turn-2 darebbe -1 e non è valido,
                        //quindi correggo riportando il suo valore a 1.
                        //Se si tratta dei turni dal 2 in poi (registrati nel campo JSON parametri
                        //sul database) allora effettuo il calcolo della diferrenza $turn-2
                        $turnCorrect = (($turn-2)===-1)?1:$turn-2;
                    ?>
                        <?= $form->field($prenotazioni, 'cognome')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($prenotazioni, 'nome')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($prenotazioni, 'email')->textInput(['type'=>'email', 'maxlength' => true]) ?>
                        <?= $form->field($prenotazioni, 'prenotazioni')->textInput(['type'=>'number', 'min' => 1, 
                                    'max' => ($n_of_turns==1)?
                                                ($model->posti_disponibili-$posti_occupati) :
                                                ($model->parametri->dates->days[$turnCorrect]->place - Prenotazioni::find()->where(['attivita_id' => $model->id, 'turno' => $turn])->sum('prenotazioni'))
                            ])->label(Yii::t('app', 'Numero di partecipanti')) ?>
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