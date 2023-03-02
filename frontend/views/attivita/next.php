<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'La nostra programmazione');
?>
<h1><?= Html::encode($this->title) ?></h1>

<div id="next">
	<?php if($page == 0):?>
		<div class="alert alert-info"><?= Yii::t('app', 'Al momento non ci sono eventi in programma')?></div>
	<?php endif; ?>
	
    <?php foreach ($attivita as $evento): ?>
        <div class="row">
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