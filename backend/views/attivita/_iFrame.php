<?php
/**
 * Visualizza la sezione di caricamento delle immagini e quelle già caricate nel sistema.
 */
use yii\widgets\ActiveForm;
?>
<div id="iframe" class="iframe auto over-element">
    <div class="exit">
        <i class="fas fa-times-circle"></i>
    </div>
    <div class="img-container">
        <?php $form = ActiveForm::begin(['action' =>['attivita/upload'], 'options' => ['enctype' => 'multipart/form-data']]) ?>
                <div class="bar">
                <?= $form->field($upload, 'mediaFile')->fileInput()->label(Yii::t('app', 'Seleziona un\'immagine')) ?>

                <button class="btn btn-success" type="submit"><?= Yii::t('app', 'Carica immagine')?></button>
                </div>
        <?php ActiveForm::end() ?>
        <ul class="imgs">
            <?php  foreach($media as $key => $value) :?>
                <li class="attachment">
                    <div class="attachment-preview js--select-attachment type-image subtype-jpeg landscape">
                        <div class="thumbnail" data-url="<?= $value->link ?>">
                            <div class="centered">
                                <img src="<?= $value->link ?>" />
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>