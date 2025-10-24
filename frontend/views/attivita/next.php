<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Eventi in programma');
?>
<h1><?= Html::encode($this->title) ?></h1>

<div id="next" class="next-view">
    <?php if($page == 0):?>
        <div class="alert alert-info"><?= Yii::t('app', 'Al momento non ci sono eventi in programma')?></div>
    <?php endif; ?>
    
    <?php foreach ($attivita as $evento): ?>
        
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
                <div class="date"><i class="fas fa-calendar-alt"></i> <?= $evento->data_attivita ?></div>
                
                <?php if($evento->pagamento == "yes") : ?>
                <div class="payment"><i class="fas fa-euro-sign"></i> <?= $evento->costo ?></div>
                <?php endif; ?>
                
                
                <div class="reservation">
                    <?php if($evento->prenotazione == "yes") : ?> 
                    <i class="fas fa-ticket-alt"></i> <?= $evento->costo ?>
                    <?php endif; ?>
                    <i class="fas fa-chair"></i> <?= $evento->posti_disponibili == null ? Yii::t('app', "Nessuna limitazione di posti") : $evento->posti_disponibili ?>
                </div>
                
                <div class="description"><i class="fa-solid fa-align-center"></i> 
                    <?php
                        echo substr($evento->descrizione, 0, 600)." ";
                        
                        echo ((substr($evento->descrizione, 0, 600) <> $evento->descrizione) ? 
                                Html::a("[...]", ['/attivita/info', 'id' => $evento->id]) : 
                                ""
                            );
                    ?>
                </div>
            </div>

            <!--<pre>
                <?php print_r($evento) ?>
            </pre>-->
        </div>
        
        <!--<div class="row">
            <div class="col">
                <div class="wrapper">
                    <div class="img" style="background-image: url(<?= "../../backend/web/".$evento->foto ?: "" ?>)"></div>
                </div>

                <div class="content">
                    <h4 class="title <?= $evento->annullato == 'yes'?'line-through':'' ?>">
                        <i class="fas fa-signature"></i> <?= Html::a($evento->nome, ['/attivita/info', 'id' => $evento->id]); ?>
                    </h4>
                    
                    <?php if($evento->annullato == "yes") : ?>
                    <div class="canceled"><i class="fas fa-ban"></i> <?= Yii::t('app', "Annullato") ?></div>
                    <?php endif; ?>
                    
                    <div class="place"><i class="fas fa-map-pin"></i> <?= $evento->luogo ?></div>
                    <div class="date"><i class="fas fa-calendar-alt"></i> <?= $evento->data_attivita ?></div>
                    
                    <?php if($evento->pagamento == "yes") : ?>
                    <div class="date"><i class="fas fa-euro-sign"></i> <?= $evento->costo ?></div>
                    <?php endif; ?>
                    
                </div>
            </div>

            <div class="canyon"></div>
        </div>
        -->
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
	<?php //print_r($attivita); ?>
</pre>

<?php
$this->registerCssFile("@web/css/next.css");
$this->registerCssFile("@web/css/pagination.css");