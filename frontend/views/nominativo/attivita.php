<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Attivita di: {nome}',
    [
        'nome' => $nominativo->nome,
    ]
);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nominativo-attivita">
	
	<h1><?= Html::encode($this->title) ?></h1>
	
	<div id="user-info">
		<div class="img">
			<?= Html::img("../../backend/web/".$nominativo->foto, ['style' => 'width: 150px']) ?>
		</div>
		
		<div class="info">
			<div><span><?= Yii::t('app', 'Nome:')?> </span> <?= $nominativo->nome ?></div>
			<div><span><?= Yii::t('app', 'Cognome:')?> </span> <?= $nominativo->cognome ?></div>
			<div><span><?= Yii::t('app', 'Dati di nascita:')?> </span> <?= date('d-m-Y', strtotime($nominativo->data_di_nascita)) ?></div>
		</div>
	</div>
	
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'nome',
            'luogo',
            'data_attivita:date',
            'foto' => [
                'label' => Yii::t('app', 'Foto'),
                'attribute' => 'foto',
                'format' => 'html',
                'value' => function($model){
                    return Html::img('../../backend/web/'.$model->foto, ['style' => 'width: 150px;']);
                }
            ],
        ],
    ]); ?>
	
</div>

<?php
$this->registerCssFile('@web/css/pagination.css');