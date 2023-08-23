<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Gestisci prenotazione: {spettacolo}', [
    'spettacolo' => $spettacolo->spettacolo,
]);
?>
<h1><?= Html::encode( $this->title ) ?></h1>

<?php //Buttons ?>

<?php
//Messaggio nessun ticket
if(isset($prenotazioni) && sizeof($prenotazioni) === 0):
?>
<p class="alert alert-info"><?= Yii::t('app', 'Nessun ticket emesso') ?></p>
<?php endif; ?>

<?php foreach($prenotazioni as $k => $p) : ?>
    
    <h5><?= ucwords($k) ?></h5>
    
    <?php foreach (isset($p->file)?$p->file:$p->palco as $fila_palco => $posto) : ?>
    <div>
        <?= isset($p->file)?Yii::t('app', 'Fila: '):Yii::t('app', 'Palco: '); ?> <strong><?= $fila_palco ?></strong>
        
        <?php if(isset($posto->posti)): ?>
            <?php foreach($posto->posti as $posto) : ?>
                <div>
                    <?= Yii::t('app', 'Posto: ') . $posto ?>
                    <?= Html::a('<i class="fa fa-trash-alt"></i>', ['delete-place', 'spettacolo_id' => $spettacolo_id, 'email' => $email]) ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div>
                <?= Yii::t('app', 'Palco non numerato') ?> <br />
                <?= Yii::t('app', 'Posti prenotati: ') ?>
                <strong><?= $posto->non_numerato ?></strong>
                <?= Html::a('<i class="fa fa-trash-alt"></i>', ['delete-place', 'spettacolo_id' => $spettacolo_id, 'email' => $email]) ?>
            </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
    

<?php endforeach; ?>

<!--<pre>
    <?php print_r($prenotazioni); ?>
</pre>-->