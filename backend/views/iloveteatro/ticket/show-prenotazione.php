<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

<div class="flex gap-2">
    <?php foreach($prenotazioni as $k => $p) : ?>

        <div class="item max-w-1">
        <h5><?= ucwords($k) ?></h5>

        <?php foreach (isset($p->file)?$p->file:$p->palco as $fila_palco => $posto) : ?>
        <div>
            <?= isset($p->file)?Yii::t('app', 'Fila: '):Yii::t('app', 'Palco: '); ?> <strong><?= $fila_palco ?></strong>

            <?php if(isset($posto->posti)): ?>
                <?php foreach($posto->posti as $k_posto => $posto) : ?>
                <div class="drop">
                        <?= Yii::t('app', 'Posto: ') . $posto ?>
                        <?= Html::a('<i class="fa fa-trash-alt"></i>', 
                                    ['delete-place', 'spettacolo_id' => $spettacolo_id, 'email' => $email], 
                                    [
                                        'class'             => 'delete-js',
                                        'data-type'         => $k,
                                        'data-fila-palco'   => $fila_palco,
                                        'data-posto'        => $k_posto,
                                    ]) ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php if(isset($posto->non_numerato)) : ?>
                <div class="drop">
                    <?= Yii::t('app', 'Palco non numerato') ?> <br />
                    <?= Yii::t('app', 'Posti prenotati: ') ?>
                    <strong><?= $posto->non_numerato ?></strong>
                    <?= Html::a('<i class="fa fa-trash-alt"></i>', ['delete-place', 'spettacolo_id' => $spettacolo_id, 'email' => $email], 
                                    [
                                        'class'     => 'delete-js',
                                        'data-type' => $k,
                                        //'data-fila-palco'   => $fila_palco,
                                        //'data-posto'        => $k_posto,
                                    ]) ?>
                </div>
                <?php else : ?>            
                    <?php foreach($posto->fila as $fila => $p) : ?>
                        <div>
                            <?= Yii::t('app', 'Fila: ') ?> <strong><?= $fila ?></strong>
                        </div>

                        <?php foreach($p->posti as $posto => $p1) : ?>
                            <div class="drop">
                                <?= Yii::t('app', 'Posto: ') ?> <strong><?= $p1 ?></strong>
                                <?= Html::a('<i class="fa fa-trash-alt"></i>', ['delete-place', 'spettacolo_id' => $spettacolo_id, 'email' => $email], 
                                    [
                                        'class'     => 'delete-js',
                                        'data-type' => $k,
                                        'data-fila-palco'   => $fila_palco,
                                        'data-posto'        => $posto,
                                        'data-fila'         => $fila,
                                    ]) ?>
                            </div>
                        <?php endforeach; ?>
                   <?php endforeach; ?>

                <?php endif; ?>

            <?php endif; ?>

        </div>
        
        <hr />
        
        <?php endforeach; ?>
        </div>
        
    <?php endforeach; ?>
</div>
        
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div>
            <input type="hidden" name="prenotazione" id="prenotazione_result" />
        </div>
        <div>
            <input type="submit" value="<?= Yii::t('app', 'Salva'); ?>" class="btn btn-iloveteatro" />
        </div>
<?php ActiveForm::end(); ?>

<!--<pre>
    <?php print_r($prenotazioni); ?>
</pre>-->
    
<?php
$prenotazioni = json_encode($prenotazioni);
$this->registerJs("
    //Riscrive le prenotazioni
    
    var prenotazioni = {$prenotazioni};
        
    jQuery('.delete-js').click(function(e){
        e.preventDefault();
        
        let _target = jQuery(e.currentTarget);
        
        _target.parents('.drop').remove();
        
        let key_type        = _target.data('type');
        let key_fila_palco  = _target.data('fila-palco');
        let key_posto       = _target.data('posto');
        
        if(key_type.includes('ordine') || key_type.includes('Ordine')){//Rimozione di un posto nei palchi
            let key_fila       = _target.data('fila');
            delete prenotazioni[key_type]['palco'][key_fila_palco]['fila'][key_fila]['posti'][key_posto];
        }else{
            delete prenotazioni[key_type]['file'][key_fila_palco]['posti'][key_posto];
        }
        
        $('#prenotazione_result').val(JSON.stringify(prenotazioni));
        
    });
");