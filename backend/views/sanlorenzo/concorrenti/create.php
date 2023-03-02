<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Nuovo concorrente');
?>
<div id="concorrente-create">
    <h1><i class="fa-solid fa-user"></i> <?= Html::encode($this->title) ?></h1>
    
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        
        <div class="action-bar">
            <?= Html::submitButton(Yii::t('app', 'Iscriviti'), ['class' => 'btn btn-success']) ?>
        </div>
    
        <?php //Allegao A ?>
        <h3><?= Yii::t('app', 'Allegato A - Modulo di iscrizione'); ?></h3>
        <h6><?= Yii::t('app', 'Riservato al responsabile del gruppo'); ?></h6>
        <p>&nbsp;</p>
        <?= $form->field($model, 'nome_gruppo')->textInput()->label("Nome gruppo (se solista inserire il proprio nome e cognome)") ?>
        <?= $form->field($model, 'nome')->textInput() ?>
        <?= $form->field($model, 'cognome')->textInput() ?>
        <?= $form->field($model, 'data_di_nascita')->textInput([
            'type' => 'date',
        ]) ?>
        <div class="flex gap-1">
            <div class="w-100 f-shrink-05">
                <?= $form->field($model, 'luogo_di_nascita')->textInput() ?>
            </div>
            <div class="w-100 f-shrink-2">
                <?= $form->field($model, 'provincia_nascita')->textInput() ?>
            </div>
        </div>
        
        <?= $form->field($model, 'citta_residenza')->textInput() ?>
        
        <div class="flex gap-1">
            <div class="w-100 f-shrink-05">
                <?= $form->field($model, 'indirizzo')->textInput() ?>
            </div>
            <div class="w-100 f-shrink-2">
                <?= $form->field($model, 'numero_civico')->textInput() ?>
            </div>
            <div class="w-100 f-shrink-2">
                <?= $form->field($model, 'provincia_residenza')->textInput() ?>
            </div>
        </div>
        <div class="flex gap-1">
            <div class="w-100">
                <?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>
            </div>
            <div class="w-100">
                <?= $form->field($model, 'cellulare')->textInput() ?>
            </div>
        </div>
        <?= $form->field($model, 'brani')->textarea([
            'rows' => 2,
            'placeholder' => Yii::t('app', 'Inserire i due brani scelti, uno per riga'),
        ]) ?>
        
        <?= Yii::t('app', 'Come partecipi? ') ?>
        <div class="flex gap-1">
            <?= $form->field($model, 'tipo')->textInput([
                'type' => 'radio',
                'value' => 'solista',
                'id' => 'tipo-solista', 
                'data-click-show' => 'solista',
            ])->label("Solista") ?>
            <?= $form->field($model, 'tipo')->textInput([
                'type' => 'radio',
                'value' => 'gruppo',
                'id' => 'tipo-gruppo',
                'data-click-show' => 'gruppo',
            ])->label("Gruppo") ?>
        </div>
        <!--<label for="tipo-solista"><?= Yii::t('app', 'Solista') ?></label> <input id="tipo-solista" data-click-show="solista" type="radio" name="tipo" value="solista" />
        <label for="tipo-gruppo"><?= Yii::t('app', 'Gruppo') ?></label> <input id="tipo-gruppo" data-click-show="gruppo" type="radio" name="tipo" value="gruppo" />
        -->
        
        <div id="gruppo" data-show="gruppo" class="append-clone">
            <span class="btn btn-success clone">
                <i class="fa-solid fa-plus"></i> Aggiungi un componente
            </span>
            <div data-clone class="flex gap-1">
                <?= $form->field($model, 'componenti[]')->textInput(['placeholder' => 'Nominativo'])->label(false) ?>
                <?= $form->field($model, 'date_di_nascita[]')->textInput(['placeholder' => 'Data di nascita', 'type' => 'date'])->label(false) ?>
                <?= $form->field($model, 'strumenti[]')->textInput(['placeholder' => 'Strumento suonato'])->label(false) ?>
            </div>
        </div>
        
        <?= $form->field($model, 'contest')->hiddenInput(['value' => $contest->id])->label(false) ?><?= Yii::t('app', 'Firma a mano') ?>
        
        
        <div class="flex gap-1">
            <div>
                <?php //Allegato A ?>
                <h3><?= Yii::t('app', 'Allegato A - Modulo di iscrizione'); ?></h3>
                <h6><?= Yii::t('app', 'Caricare il modulo di iscrizione'); ?></h6>
                <?= $form->field($allegatoA, 'allegatoA[]')->fileInput(['value' => $contest->id, 'multiple' => true, 'accept' => 'image/*, application/pdf']) ?>

                <?php //Allegato B ?>
                <h3><?= Yii::t('app', 'Allegato B - Contratto artista'); ?></h3>
                <h6><?= Yii::t('app', 'Caricare un contratto per ogni artista'); ?></h6>
                <?= $form->field($allegatoB, 'allegatoB[]')->fileInput(['value' => $contest->id, 'multiple' => true, 'accept' => 'image/*, application/pdf']) ?>

                <?php //Allegato C ?>
                <h3><?= Yii::t('app', 'Allegato C - Liberatoria'); ?></h3>
                <h6><?= Yii::t('app', 'Caricare un contratto per ogni artista'); ?></h6>
                <?= $form->field($allegatoC, 'allegatoC[]')->fileInput(['value' => $contest->id, 'multiple' => true, 'accept' => 'image/*, application/pdf']) ?>

                <?php //Bonifico ?>
                <h3><?= Yii::t('app', 'Copia del bonifico'); ?></h3>
                <h6><?= Yii::t('app', 'Carica una copia del bonifico'); ?></h6>
                <?= $form->field($bonifico, 'bonifico[]')->fileInput(['value' => $contest->id, 'multiple' => true, 'accept' => 'image/*, application/pdf']) ?>
            </div>
            
            <div class="width-100">
                <?= $form->field($model, 'note')->textarea(['rows' => 10]) ?>
            </div>
        </div>
        
        
        <div class="action-bar">
            <?= Html::submitButton(Yii::t('app', 'Iscriviti'), ['class' => 'btn btn-success']) ?>
        </div>
        
    <?php ActiveForm::end(); ?>
    
</div>

<?php
$this->registerJs("
    //clone element
    $('.clone').click(function(){
        $('[data-clone]').clone(true).removeAttr('data-clone').appendTo('.append-clone');
        
        //Delete content from copied input
        var last_input = $('.append-clone > div:last-child input').val('');
        
    });

    //Show group info
    $('[data-click-show]').click(function(){
        var shows = $('[data-show]');
        
        $(shows).hide();//hide all selected elements
        
        $('[data-show='+$(this).data('click-show')+']').toggle();
    });
");