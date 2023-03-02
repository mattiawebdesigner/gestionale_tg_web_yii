<?php
use yii\helpers\Html;
use backend\models\DocumentazioneCategorie;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentazioneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categoria') . ': ' . Yii::t('app', DocumentazioneCategorie::findOne($docs[0]->documentazione_categoria_id)->categoria);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentazione-index">
    <h1><?= Html::encode($this->title) ?></h1>
	<h6><?= Yii::t('app', 'Area trasparenza') ?></h6>
    
    <div id="documenti" class="documenti container">
    	<div class="row">
    	<?php foreach ($docs as $val): ?>
    		<div class="col col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
    			<div class="title">
    				<h4><?= $val->fileName ?></h4>
    			</div>
        		
        		<div class="content">
        			<?= Html::a('<i class="fas fa-mouse cursor"></i>', ['/documentazione/single-view', 'id' => $val->id]) ?>
        			
            		<?php if($val->mime == "application/pdf") : ?>
        				<iframe src="<?= $val->link ?>" type="<?= $val->mime ?>" scrolling="no" style="overflow: hidden;"></iframe>
            		<?php else: ?>
            			<img src="<?= $val->link ?>" alt="<?= $val->fileName ?>" />
            		<?php endif; ?>
        		</div>
        		
        		<div class="info">
        			<div title="<?= Yii::t('app', 'Data e orario di inserimento') ?>">
        				<i class="far fa-calendar-alt"></i> <?= $val->data_inserimento ?>
        			</div>
        			<div title="<?= Yii::t('app', 'Categoria del documento') ?>">
        				<i class="far fa-list-alt"></i> 
        				<?= Html::a( DocumentazioneCategorie::findOne($val->documentazione_categoria_id)->categoria, ['category-socio-all', 'cat_id' => $val->documentazione_categoria_id] )?>
        			</div>
        		</div>
    		</div>
    	<?php endforeach; ?>
    	</div>
    </div>
    

</div>

<?php
$this->registerCssFile("@web/css/documenti.css", [
    'position' => \yii\web\View::POS_END,
]);