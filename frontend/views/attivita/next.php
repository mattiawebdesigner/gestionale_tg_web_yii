<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Eventi in programma');
?>
<h1><?= Html::encode($this->title) ?></h1>

<div id="next" class="next-view">
    <?php if($page == 0):?>
        <div class="alert alert-info"><?= Yii::t('app', 'Al momento non ci sono eventi in programma')?></div>
    <?php endif; ?>
    
    <?php foreach ($attivita as $evento): ?>
        <?php 
        $evento->parametri  = json_decode($evento->parametri); 
        $n_of_turns         = sizeof((array)$evento->parametri->dates->days)+1;
        ?>
        
        <div class="event">

            <h4 class="title <?= $evento->annullato == 'yes'?'line-through':'' ?>">
                <i class="fa-brands fa-elementor"></i> <?= Html::a($evento->nome, ['/attivita/info', 'id' => $evento->id]); ?>
            </h4>

            <div class="wrapper">
                <div class="img" style="background-image: url(<?= "../../backend/web/".$evento->foto ?: "" ?>)"></div>
            </div>

            <div class="content">
                <?php if($evento->annullato == "yes") : ?>
                <div class="canceled"><i class="fas fa-ban"></i> <?= Yii::t('app', "Evento annullato") ?></div>
                <?php endif; ?>
                
                <div class="place"><i class="fas fa-map-pin"></i> <?= $evento->luogo ?></div>
                
                <?php if($evento->pagamento == "yes") : ?>
                <div class="payment"><i class="fas fa-euro-sign"></i> <?= $evento->costo ?></div>
                <?php endif; ?>
                
                <?php if($n_of_turns > 1): ?>
                <div class="turns">
                    <div><strong><?= $n_of_turns ?> <?= Yii::t('app', 'turni (clicca per prenotare)') ?></strong></div>
                    <a class="date" href="<?= Url::to(['attivita/next', 'id'=>$evento->id, 'turn'=>1]) ?>">
                        <i class="fas fa-calendar-alt"></i> <strong><?= date("d-m-Y H:i", strtotime($evento->data_attivita)) ?></strong>
                        <i class="fas fa-euro-sign"></i> <strong><?= $evento->costo ?></strong>
                        <i class="fas fa-chair"></i> 
                        <strong><?= $evento->posti_disponibili == null ? Yii::t('app', "Nessuna limitazione di posti") : $evento->posti_disponibili ?></strong>
                        <?= Yii::t('app', 'Posti disponibili') ?>
                    </a>
                    <?php foreach($evento->parametri->dates->days as $k => $turn): ?>
                    <a class="date d-block" href="<?= Url::to(['attivita/next', 'id'=>$evento->id, 'turn'=>($k+2)]) ?>">
                        <i class="fas fa-calendar-alt"></i> <strong><?= date("d-m-Y H:i", strtotime($turn->date)) ?></strong>
                        <i class="fas fa-euro-sign"></i> <strong><?= $turn->price ?></strong>
                        <i class="fas fa-chair"></i> 
                        <?= !isset($turn->place) ? "<strong>".Yii::t('app', "Nessuna limitazione di posti")."</strong>" : "<strong>".$turn->place."</strong>"." ".Yii::t('app', 'Posti disponibili') ?></strong>
                        
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="date"><i class="fas fa-calendar-alt"></i> <?= $evento->data_attivita ?></div>
                <div class="reservation">
                    <?php if($evento->prenotazione == "yes") : ?> 
                    <i class="fas fa-ticket-alt"></i> <?= $evento->costo ?>
                    <?php endif; ?>
                    <i class="fas fa-chair"></i> <?= $evento->posti_disponibili == null ? Yii::t('app', "Nessuna limitazione di posti") : $evento->posti_disponibili ?>
                </div>
                <?php endif; ?>
                
                <br />
                <div class="description"><i class="fa-solid fa-align-center"></i> <strong><?= Yii::t("app", "Descrizione") ?></strong>
                    <?php
                        echo substr($evento->descrizione, 0, 600)." ";
                        
                        echo ((substr($evento->descrizione, 0, 600) <> $evento->descrizione) ? 
                                Html::a("[...]", ['/attivita/info', 'id' => $evento->id]) : 
                                ""
                            );
                    ?>
                </div>
            </div>
        </div>
        
    <?php endforeach;?>
    	
    	<?php if($page > 1) :?>
		<ul class="pagination">
            <li class="prev">
            	<?= Html::a('&laquo;', ['/attivita/next', 'offset' => $_this==0 ? $nPerPagina : $nPerPagina*($_this-1), '_this' => $_this-1], ['class' => $_this==0 ? 'disabled' : 'i']); ?>
            </li>
            <?php for($i=0; $i<$page;$i ++): ?>
            	<li class="<?= $i==$_this ? 'active' : '' ?>"><?= Html::a($i+1, ['/attivita/next', 'offset' => $nPerPagina*$i, '_this' => $i], ['data-page' => $i]) ?></li>
            <?php endfor; ?>
            <li class="next">
            	<?= Html::a('&raquo;', ['/attivita/next', 'offset' => $_this==0 ? $nPerPagina : $nPerPagina*($_this+1), '_this' => $_this+1], ['class' => $tot-1 == $_this ? 'disabled' : 'i']); ?>
            </li>
            
        </ul>
       <?php endif; ?>
</div>

<pre>
    <?php
    /*$json = json_encode([
        'dates' => [
            'days' => [
                ['date' => '2025-11-29 19:00:00', 'place' => 20],
                ['date' => '2025-11-29 19:30:00', 'place' => 20],
                ['date' => '2025-11-29 20:00:00', 'place' => 20],
                ['date' => '2025-11-29 20:30:00', 'place' => 20]
            ]
        ]
    ]);*/
    ?>
	<?php //print_r($json); ?>
</pre>

<?php
$this->registerCssFile("@web/css/next.css");
$this->registerCssFile("@web/css/pagination.css");