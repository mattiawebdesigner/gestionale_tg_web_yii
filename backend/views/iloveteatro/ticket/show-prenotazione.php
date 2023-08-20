<?php
use yii\helpers\Html;
use app\models\IltPrenotazioni;
use app\models\IltFila;
use app\models\IltPlatea;
use app\models\IltPalco;
use app\models\IltOrdine;
use app\models\IltPosto;

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

<?php foreach($prenotazioni as $prenotazione) : ?>
    <div class="flex gap-1">

        <div class="back">
            <?= Html::a('<i class="fa-solid fa-chevron-left"></i> ', ['prenotazioni', 
                                                                'spettacolo_id' => $prenotazione->spettacolo,
                                                        ], [
                'class' => 'btn btn-info',
                'title' => Yii::t('app', 'Segna tutte le prenotazioni come non pagate'),
                'data' => [
                    'confirm' => Yii::t('app', 'Tornare indietro?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>

        <div class="frontend-page">
            <a href="<?= Yii::$app->params['site_protocol'] ?><?= Yii::$app->params['sito'] ?>/iloveteatro/frontend/web/?r=site/map&spettacolo_id=<?= $prenotazione->spettacolo ?>"
               class="btn btn-info" 
               title="<?= Yii::t('app', 'Segna la prenotazione come pagata') ?>" 
               target="_blank">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </a>
        </div>

        <div class="paided-ticket">
            <?= Html::a('<i class="fa-solid fa-circle-dollar-to-slot"></i> ', ['paided-ticket',
                                                                'spettacolo_id' => $prenotazione->spettacolo,
                                                                'email' => $prenotazione->email
                                                        ], [
                'class' => 'btn btn-success',
                'title' => Yii::t('app', 'Segna tutte le prenotazione come pagate'),
                'data' => [
                    'confirm' => Yii::t('app', 'Sei sicuro di voler segnare tutte le prenotazioni come pagate?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>

        <div class="paided-no-ticket">
            <?= Html::a('<i class="fa-solid fa-square-minus"></i> ', ['paided-no-ticket', 
                                                                'spettacolo_id' => $prenotazione->spettacolo,
                                                                'email' => $prenotazione->email
                                                        ], [
                'class' => 'btn btn-warning',
                'title' => Yii::t('app', 'Segna tutte le prenotazioni come non pagate'),
                'data' => [
                    'confirm' => Yii::t('app', 'Sei sicuro di voler segnare tutte le prenotazioni come non pagate?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
    <?php //end buttons ?>

    <hr />

    <p><i class="fa-solid fa-envelope"></i> <?= Html::mailto($prenotazione->email) ?></p>

    <?php break; ?>

<?php endforeach; ?>

<hr />

<div>
    <?= Yii::t('app', 'Prenotazioni pagate') ?>: <strong class="c-darkgreen"><?= \app\models\IltPrenotazioni::find()->where(['email' => $prenotazione->email, 'spettacolo' => $prenotazione->spettacolo, 'pagato' => \app\models\IltPrenotazioni::PAGATO])->count(); ?></strong>
</div>
<div>
    <?= Yii::t('app', 'Prenotazioni da pagare') ?>: <strong class="c-iloveteatro"><?= \app\models\IltPrenotazioni::find()->where(['email' => $prenotazione->email, 'spettacolo' => $prenotazione->spettacolo, 'pagato' => \app\models\IltPrenotazioni::NON_PAGATO])->count(); ?></strong>
</div>
<div>
    <?= Yii::t('app', 'Totali prenotazioni') ?>: <strong><?= \app\models\IltPrenotazioni::find()->where(['email' => $prenotazione->email, 'spettacolo' => $prenotazione->spettacolo])->count(); ?></strong>
</div>

<hr />

<div class="flex gap-1 flex-wrap-wrap">
    <?php foreach($prenotazioni as $prenotazione) : ?>

        <?php
        $posto = IltPosto::find()->where(['id' => $prenotazione->posto])->one();
        ?>

        <div class="name">
            <div class="flex gap-1">
            <?php if($prenotazione->pagato === IltPrenotazioni::NON_PAGATO) : ?>
                    <div class="paided-ticket">
                        <?= Html::a('<i class="fa-solid fa-circle-dollar-to-slot"></i> ', ['paided-ticket', 
                                                                            'id' => $prenotazione->id,
                                                                            'spettacolo_id' => $prenotazione->spettacolo,
                                                                            'email' => $prenotazione->email
                                                                    ], [
                            'class' => 'btn btn-success',
                            'title' => Yii::t('app', 'Segna la prenotazione come pagata'),
                            'data' => [
                                'confirm' => Yii::t('app', 'Sei sicuro di voler segnare questa prenotazione come pagata?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                    </div>
                    <?php else: ?>
                    <div class="paided-no-ticket">
                        <?= Html::a('<i class="fa-solid fa-square-minus"></i> ', ['paided-no-ticket', 
                                                                            'id' => $prenotazione->id,
                                                                            'spettacolo_id' => $prenotazione->spettacolo,
                                                                            'email' => $prenotazione->email
                                                                    ], [
                            'class' => 'btn btn-warning',
                            'title' => Yii::t('app', 'Segna la prenotazione come non pagata'),
                            'data' => [
                                'confirm' => Yii::t('app', 'Sei sicuro di voler segnare questa prenotazione non come pagata?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                    </div>
                    <?php endif; ?>

                    <div class="trash">
                        <?= Html::a('<i class="fas fa-trash"></i> ', ['ticket-delete', 
                                                                            'id' => $prenotazione->id,
                                                                            'spettacolo_id' => $prenotazione->spettacolo,
                                                                            'email' => $prenotazione->email
                                                                    ], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Sei sicuro di voler cancellare questa prenotazione?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                    </div>
            </div>

            <!--<p>&nbsp;</p>
            <p>Nome e Cognome: <strong><?= $prenotazione->cognome ?> <?= $prenotazione->nome ?></strong></p>
            <p>Email: <strong><?= $prenotazione->email ?></strong></p>
            <p>Telefono: <strong><?= $prenotazione->cellulare ?></strong></p>-->
            <p>
                <?php
                $fila = IltFila::findOne($posto->fila);
                $platea = IltPlatea::findOne(['fila' => $fila->id]);
                $palco = IltPalco::findOne(['fila' => $fila->id]);
                $ordine = null;
                ?>
                <strong class="c-1">
                    <?= (($platea<>null)?"Platea":
                            (
                                ($ordine<>null)?:IltOrdine::findOne($palco->ordine)->ordine." ".Yii::t('app', 'Ordine')
                            )
                        ) ?> <br />
                    <?= $palco <> null ? Yii::t('app', 'Palco: ')."<mark>".$palco->palco."</mark>" : ''  ?> 
                    <?= Yii::t('app', 'Fila: ') ?><mark><?= $fila->nome_fila  ?></mark>
                    <?= Yii::t('app', 'Posto: ') ?><mark><?= $posto->posto ?></mark>
                </strong>

                <p><i class="fa-solid fa-user"></i> <?= $prenotazione->nome ?> <?= $prenotazione->cognome ?></p>
                <p><i class="fa-solid fa-phone"></i> <?= Html::a($prenotazione->cellulare, 'tel: '.$prenotazione->cellulare) ?></p>
            </p>
                <hr />
        </div>
    <?php endforeach; ?>
</div>