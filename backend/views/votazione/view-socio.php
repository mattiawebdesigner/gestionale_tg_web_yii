<?php

use yii\helpers\Html;
use scotthuangzl\googlechart\GoogleChart;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\VociSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Votazione {anno}', [
    'anno' => $votazione->anno,
]);
$this->params['breadcrumbs'][] = $this->title;

$info = json_decode($votazione->info);
$cont = 0;
?>
<div class="votazione-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p> 
        <?= Html::a(Yii::t('app', '<i class="fa-solid fa-list"></i> Tutte le votazioni'), ['index-socio'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', '<i class="fa-solid fa-download"></i> Scarica soci con diritto di voto'), ['download-elenco-soci-voto', 'id' => $votazione->id], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
    </p>
    
     
    <?php //Informazioni sulla votazione ?>
    <div class="anno">
        <i class="fa-solid fa-calendar-days"></i> <?= $votazione->anno ?>
    </div>

    <div class="luogo">
        <i class="fa-solid fa-location-dot"></i> <?= $votazione->luogo ?>
    </div>
    
    <?php foreach ($info as $k => $i) : ?>
    <div class="data flex gap-1">
        <div>
            <i class="fa-solid fa-calendar-days"></i> <?= $i->data ?>
        </div>
        <div>
            <i class="fa-solid fa-hourglass-start"></i> <?= $i->ora_inizio ?>
        </div>
        <div>
            <i class="fa-solid fa-hourglass-end"></i> <?= $i->ora_fine ?>
        </div>
    </div>
    <?php endforeach; ?>
    
    <?php 
    if(sizeof($votazione_has_voti) > 0) :
        $data = array(
            array('Task', 'Voti'),
        );
        foreach ($votazione_has_voti as $k => $v){
            ///$data[] = array($v['cognome']." ".$v['nome'], $v['tot_voti']);
            array_push($data, array($v['cognome']." ".$v['nome'], $v['tot_voti']));
        }
        echo GoogleChart::widget(array('visualization' => 'ColumnChart',
                    'data' => $data,
                    'options' => array(
                        'title' => 'Risultati delle votazioni'),
                    )
            );
        /*echo "<pre>";
        print_r($rosa_eletti);
        echo "</pre>";*/
    ?>
        
    <div class="eletti">
        <h3><?= Yii::t('app', 'Eletti') ?></h3>
        
        <?php foreach ($rosa_eletti as $k => $v) : ?>
        <div><strong>#<?= $k+1 ?></strong> <?= $v['cognome']." ".$v['nome'] ?> (<?= $v['tot_voti'] ?> voti)</div>
        <?php endforeach; ?>
        
    </div>
        
    <div class="non_eletti">
        <h3><?= Yii::t('app', 'Non Eletti') ?></h3>
        
        <?php foreach ($non_eletti as $k => $v) : ?>
        <div><strong>#<?= $k+6 ?></strong> <?= $v['cognome']." ".$v['nome'] ?> (<?= $v['tot_voti'] ?> voti)</div>
        <?php endforeach; ?>
        
    </div>
        
    <?php else :?>   
    <p class="alert alert-info">
        <?= Yii::t('app', 'Non sono ancora stati inseriti voti per queste elezioni') ?>
    </p>
    <?php endif; ?>
    
    <?php //Elenco dei soci con diritto di voto ?>
    <!--<h3><?= Yii::t('app', 'Soci con diritto di voto') ?></h3>
    <div class="soci">
        <table class="table table-striped">
            <tr>
                <th>#</th>
                <th>Socio</th>
            </tr>
            
            <?php foreach($soci as $k => $v): ?>
            <tr>
                <td><?= ++ $cont ?></td>
                <td><?= $v['cognome']." ".$v['nome'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>-->
</div>