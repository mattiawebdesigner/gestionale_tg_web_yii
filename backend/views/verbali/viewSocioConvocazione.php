<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Verbali */

$ordine_del_giorno = explode("\n", $model->ordine_del_giorno);

$this->title = $model->oggetto;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Verbali'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="verbali-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('<i class="fas fa-download"></i> ', ['/convocazioni/download', 'numero_protocollo' => $model->numero_protocollo], ['class' => 'btn btn-warning']) ?>
    </p>
    
    <h4>Prot: <?= $model->numero_protocollo ?></h4>
    <h5><i class="fas fa-calendar"></i> <?= date('d-m-Y', strtotime($model->data_assemblea)) ?></h5>
    <h5><i class="fas fa-signature"></i>
        <?php
        if(isset($model->firma['firma_autografa'])): ?>
            <img style="width: 250px;" src="<?= $model->firma['firma_autografa'] ?>" />
        <?php else: ?>
            <?= $model->firma['firma'] ?>
        <?php endif; ?>
    </h5
    
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
            <td><strong><?= Yii::t('app', 'Data') ?></strong> <br /><?= date('d-m-Y', strtotime($model->data_inserimento)) ?></td>
            <td>
                <strong><?= Yii::t('app', 'Firma') ?></strong> <br />
            
                <?php
                if(isset($model->firma['firma_autografa'])): ?>
                    <img style="width: 250px;" src="<?= $model->firma['firma_autografa'] ?>" />
                <?php else: ?>
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
