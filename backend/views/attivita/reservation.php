<?php
    /**
     * Resrvation of the selected event
     */
?>
<?php
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AttivitaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Prenotazioni {name}',[
    'name' => $model->nome,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attività'), 'url' => ['/attivita/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Elenco eventi'), 'url' => ['/attivita/reservations']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>

<div id="attivita-reservation" class="container event">
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <div class="wrapper">
                <div class="img" style="background-image: url(<?= "../../backend/web/".$model->foto ?: "" ?>)"></div>
            </div>
        </div>
        
        <div class="col-sm-8 col-md-8 col-lg-8">
            <div class="info">
                <?php if($model->annullato == "yes") : ?>
                <div class="canceled"><i class="fas fa-ban"></i> <?= Yii::t('app', "Annullato") ?></div>
                <?php endif; ?>

                <div class="place"><i class="fas fa-map-pin"></i> <?= $model->luogo ?></div>
                <!--<div class="date"><i class="fas fa-calendar-alt"></i> <?= $model->data_attivita ?></div>-->

                <?php if($model->pagamento == "yes") : ?>
                <div class="date"><i class="fas fa-euro-sign"></i> <?= $model->costo ?></div>
                <?php endif; ?>
                
                <!--<div class="chair">
                    <i class="fas fa-chair"></i> <?= $model->posti_disponibili == null ? "Nessuna limitazione" : $placesLeft ?>
                </div>-->
                
                <?php foreach($reservations as $turn => $values): ?>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>
                                    <div class="flex flex-row justify-content-between">
                                        <h3 class="title"><?= Yii::t('app', 'Turno {t}', ['t' => $turn]) ?></h3>
                                        <div class="flex flex-column">
                                            <div class="chair">
                                                <i class="fas fa-calendar-alt"></i> 
                                                <?= date("d-m-Y H:i", strtotime(explode("|", key($values))[0])) ?>
                                            </div>
                                            <div class="price">
                                                <i class="fas fa-euro"></i> 
                                                <?= explode("|", key($values))[1] ?>
                                            </div>
                                            <div class="place" title="<?= Yii::t('app', 'Posti totali prenotabili') ?>">
                                                <i class="fa-solid fa-chair"></i> 
                                                <?= explode("|", key($values))[2] ?>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <?php foreach($values[key($values)] as $date => $book): ?>
                            <tr>
                                <td>
                                    <div class="flex flex-row gap-1">                   
                                        <div>
                                            <i class="fas fa-user"></i> <strong> <?= $book['cognome'] ?> <?= $book['nome'] ?></strong>
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-envelope"></i> <?= $book['email'] ?>
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-chair"></i> <strong> <?= $book['prenotazioni'] ?></strong>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerCssFile('@web/css/event.css');