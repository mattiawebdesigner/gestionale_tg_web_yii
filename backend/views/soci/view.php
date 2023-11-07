<?php
/**
 * View per la visualizzazione dei dettagli dei soci.
 * Visualizza:
 * <ul>
 *      <li>I dati anagrafici</li>
 *      <li>Gli anni sociali del socio</li>
 *      <li>Il file delle dimissioni, se presente</li>
 * </ul>
 */
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\functions\check_file_extension;

/* @var $this yii\web\View */
/* @var $model backend\models\Soci */
/* @var $firma backend\models\Firma */
/* @var $years backend\models\SocioAnnoSociale */

$this->title = $model->nome. " ". $model->cognome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Soci'), 'url' => ['all']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="soci-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-table"></i> ', ['all'], ['class' => 'btn btn-success']) ?>
        <!--<?= Html::a('<i class="fas fa-user-plus"></i> ', ['anno-sociale/index'], ['class' => 'btn btn-info']) ?>-->
        <?= Html::a('<i class="fas fa-pen"></i> '.Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'cognome',
            'indirizzo',
            'email:email',
            'data_registrazione',
            'data_di_nascita',
        ],
    ]) ?>
    
    <?php if($firma) : ?>
        <h5><?= Yii::t('app', 'Firma registrata'); ?></h5>
        
        <img style="max-width: 250px" src="<?= Yii::$app->params['site_protocol'].Yii::$app->params['backendWeb'].$firma->firma ?>" />
    <?php endif; ?>
    
    <h5><?= Yii::t('app', 'Anni sociali') ?></h5>
    
    <ul>
        <?php foreach($years as $year): ?>
        <li><?= Html::a($year->anno, ['anno-sociale/view', 'anno' => $year->anno]) ?></li>
        <?php endforeach; ?>
    </ul>
    
    <?php if(!is_null($model->file_dimissioni)): ?>
        <br /><br />
        
        <h5>
        <?= Yii::t('app', 'Dimissioni ricevute in data {data}', [
            'data' => date("d-m-Y", strtotime($model->data_dimissioni)),
        ]) ?>
        </h5>
    
        <?php
        $dimissioni_file = explode(".", $model->file_dimissioni);
        $ext = $dimissioni_file[sizeof($dimissioni_file)-1];
        if($ext == "pdf") : ?>
            <object data="<?= $model->file_dimissioni ?>" type="application/pdf" width="100%" height="500px">
                <p><?= Yii::t('app', 'Impossibile aprire il file.') ?></p>
            </object>
        <?php else: ?>
            <img src="<?= $model->file_dimissioni ?>" />
        <?php endif; ?>    
    <?php endif; ?>
    
</div>

<?php
$this->registerCssFile("@web/css/fontawesome-free-6.0.0-beta2-web/css/all.min.css")
?>