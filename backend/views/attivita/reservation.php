<?php
    /**
     * Resrvation of the selected event
     */
?>
<?php
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AttivitaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Url;
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
                <div class="date"><i class="fas fa-calendar-alt"></i> <?= $model->data_attivita ?></div>

                <?php if($model->pagamento == "yes") : ?>
                <div class="date"><i class="fas fa-euro-sign"></i> <?= $model->costo ?></div>
                <?php endif; ?>
                
                <div class="chair">
                    <i class="fas fa-chair"></i> <?= $model->posti_disponibili == null ? "Nessuna limitazione" : $placesLeft ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'email',
                'prenotazioni',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function($url, $model, $key){
                            return Html::a('<i class="fas fa-pencil"></i>', 
                                                ['/attivita/reservation-update', 'attivita_id' => $model->attivita_id, 'email' => $model->email]
                                          );
                        },
                        'delete' => function($url, $model, $key){
                            return Html::a('<i class="fas fa-trash-alt"></i>', 
                                                ['/attivita/reservation-delete', 
                                                    'attivita_id' => $model->attivita_id, 'email' => $model->email],
                                                ['data-confirm' => Yii::t('app', 'Sei sicuro di voler cancellare questa voce?'),
                                                    'data-method' => 'post', 'data-pjax' => '0',]
                                           );
                        }
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>

<?php
$this->registerCssFile('@web/css/event.css');