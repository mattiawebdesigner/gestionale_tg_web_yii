<?php
/**
 * Display all informations of event
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Attivita */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prossimi eventi'), 'url' => ['attivita/next']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div id="next" class="attivita-view">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="row">
        <div class="col">
            <div class="wrapper">
                <div class="img" style="background-image: url(<?= "../../backend/web/".$model->foto ?: "" ?>)"></div>
            </div>

            <div class="content">
                <div class="place"><i class="fas fa-map-pin"></i> <?= $model->luogo ?></div>

                <?php
                echo $this->render('sections/_turns',[
                    'evento'        => $model,
                ]);
                ?>
            </div>

            <div class="description">
                    <h5><?= Yii::t('app', "Note sull'evento") ?></h5>

                    <?= $model->descrizione ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerCssFile("@web/css/next.css");