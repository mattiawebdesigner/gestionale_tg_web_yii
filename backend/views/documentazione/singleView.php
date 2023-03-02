<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentazioneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->fileName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentazione-index">
	<h6><?= Yii::t('app', 'Area trasparenza') ?></h6>
    
    <div id="documento" class="documenti container">
    	<div>
        	<?= Html::a('<i class="fas fa-arrow-left"></i> ' . Yii::t('app', 'Torna indietro'), ['/documentazione/socio-view'], [
        	    'class' => 'btn btn-success back',
        	]) ?>
    	</div>
    	
    	<div class="info">
    		<div class="title"><i class="fas fa-file-signature"></i> <?= $model->fileName ?></div>
    		<div><i class="far fa-calendar-alt"></i> <?= $model->data_inserimento ?></div>
    	</div>
    	
    	<?php if($model->mime == "application/pdf") : ?>
    		<iframe src="<?= $model->link ?>" type="<?= $model->mime ?>" scrolling="no" style="overflow: hidden;"></iframe>
    	<?php else : ?>
            <img src="<?= $model->link ?>" alt="<?= $model->fileName ?>" />
    	<?php  endif; ?>
    </div>
    

</div>

<?php
$this->registerCssFile("@web/css/documenti.css", [
    'position' => \yii\web\View::POS_END,
]);