<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Media');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="imgs" class="media-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="img-container">
    	<?php $form = ActiveForm::begin(['action' =>['index'], 'options' => ['enctype' => 'multipart/form-data']]) ?>
        	<div class="bar">
                <?= $form->field($upload, 'mediaFile')->fileInput()->label(
                                                                            Yii::t('app', 'Seleziona un\'immagine'),
                                                                            ['class' => 'file control-label'],
                                                                     ) ?>
            	<div class="form-group">
                	<button class="btn btn-success" type="submit"><i class="fas fa-upload"></i></button>
                </div>
        	</div>
        <?php ActiveForm::end() ?>
        
        <div class="clearfix"></div>
        
        <ul class="imgs">
            <?php foreach($dataProvider->getModels() as $model) : ?>
            <li class="attachment">
    			<div class="attachment-preview js--select-attachment type-image subtype-jpeg landscape">
        					<div class="trash">
        						<?= Html::a('<i class="fas fa-trash"></i> ', ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Sei sicuro di voler cancellare questo media?'),
                                        'method' => 'post',
                                    ],
                                ]) ?>
        					</div>
        					
        			<div class="thumbnail" data-url="<?= $model->link ?>">
        					<div class="centered">
        						<img src="<?= $model->link ?>" />
        					</div>
        				
        			</div>
        			
        		</div>
    		</li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <div class="clearfix"></div>

    <!--<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'link',
            'mime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>-->


</div>

<?php
$this->registerCssFile('@web/css/media.css');