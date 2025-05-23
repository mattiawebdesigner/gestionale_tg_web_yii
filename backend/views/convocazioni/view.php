<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Convocazioni */

$ordine_del_giorno = explode("\n", $model->ordine_del_giorno);

$this->title = $model->oggetto;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Convocazioni'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="convocazioni-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('<i class="fas fa-table"></i> ', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-download"></i> ', ['download', 'numero_protocollo' => $model->numero_protocollo], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="fas fa-paper-plane"></i> ', ['send', 'numero_protocollo' => $model->numero_protocollo], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="fas fa-pen"></i> '.Yii::t('app', 'Update'), ['update', 'numero_protocollo' => $model->numero_protocollo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'numero_protocollo' => $model->numero_protocollo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <h4>Prot: <?= $model->numero_protocollo ?></h4>
    <h5><i class="fas fa-calendar"></i> <?= $model->data_assemblea ?></h5>
    <h5><i class="fas fa-signature"></i> <?php 
        //Visualizza la firma, se presente
        if(isset($model->firma['firma_autografa'])): ?>
            <img 
                style="max-width: 250px" 
                src="<?= $model->firma['firma_autografa']?>" 
            />
        <?php else : ?>
            <?php
            //Altrimenti visualizza il nome del firmatario
            //usato per i vecchi verbali, prima dell'aggiornamento
            ?>
            
            <?= $model->firma['firma'] ?>
        <?php endif; ?> </h5>
    
    <p></p><p></p><p></p>
    
    <h5><?= Yii::t('app', 'Ordine del giorno') ?></h5>
    <ul>
        <?php foreach($ordine_del_giorno as $odg): ?>
        <li><?= $odg ?></li>
        <?php endforeach; ?>
    </ul>
    
    <?= $model->contenuto ?>
    
    <table class="table">
        <tr>
            <td><strong><?= Yii::t('app', 'Data') ?></strong> <br /><?= $model->data_assemblea ?></td>
            <td><strong><?= Yii::t('app', 'Firma') ?></strong> <br />
            <?php 
            //Visualizza la firma, se presente
            if(isset($model->firma['firma_autografa'])): ?>
                <img 
                    style="max-width: 250px" 
                    src="<?= $model->firma['firma_autografa']?>" 
                />
            <?php else : ?>
                <?php
                //Altrimenti visualizza il nome del firmatario
                //usato per i vecchi verbali, prima dell'aggiornamento
                ?>
            
                <?= $model->firma['firma'] ?>
            <?php endif; ?>
            </td>
        </tr>
    </table>
    
    <?php if($model->delega === "yes") : ?>
        <h5>Invia il modulo di delega</h5>

        <?php $form = ActiveForm::begin([
            'options' => [
                'data-form' => 'convocazione',
            ]
        ]); ?>
            <p>
                Io sottoscritto <?= Yii::$app->user->identity->cognome.' '.Yii::$app->user->identity->nome ?>
                <?= $form->field($delega, 'delegante')->hiddenInput(['value' => Yii::$app->user->id, 'disabled' => true])->label(false) ?>
                delego 
                <?= $form->field($delega, 'delegato')->textInput()->dropDownList(
                     ArrayHelper::map(backend\models\Soci::find()->innerJoin('utenti')->select('*')->where(['<>', 'socio_id', 0])->andWhere(['status' => \backend\models\Utenti::$ACTIVE])->all() , 'id', 'nome')
                )->label(false) ?>
                per la riunione che si terrà in data <?= date('d-m-Y', strtotime($model->data_assemblea)) ?>
            </p>
            
            <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva e chiudi'), ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
    <?php endif; ?>
</div>
