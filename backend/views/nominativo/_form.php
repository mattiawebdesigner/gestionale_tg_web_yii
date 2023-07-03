<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Nominativo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nominativo-form">

    <?php $form = ActiveForm::begin(); ?>

		<div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    
    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_di_nascita')->textInput(['type' => 'date']) ?>

	<div>
    <?= $form->field($model, 'foto')->textInput(['class' => 'append-url form-control', 'readonly' => 'readonly'])->label(Yii::t('app', 'Foto')) ?>
        
        <div class="img">
        	<?= Html::img($model->foto, [
        	    'style' => 'width: 250px;'
        	])?>
        </div>
        
        <div class="btn btn-info open-iframe"><?= Yii::t('app', 'Galleria immagini') ?></div>
	</div>
        
	<?= GridView::widget([
	    'dataProvider'  => $attivita,
	    //'filterModel'   => $searchAttivita,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'checkboxOptions' => function($model, $key, $index, $column) use ($myAttivita){
                        $find = false;

                        if($myAttivita <> null){
                            $myAttivita = $myAttivita->all();
                            foreach ($myAttivita as $key => $value){
                                if($value->id == $model->id){
                                    $find = true;
                                    break;
                                }
                            }
                        }

                        return [
                            'value'     => $model->id,
                            'checked'   => $find,
                        ];
                    }
                ],

                'nome',
                'luogo',
                'data_attivita',
                'foto' => [
                    'label' => Yii::t('app', 'Foto di copertina'),
                    'attribute' => 'foto',
                    'format' => 'html',
                    'value' => function ($model) {

                        return Html::img($model->foto, ['style' => 'width: 150px;']);
                    }
                ],
            ],
        ]); ?>

    <?php ActiveForm::end(); ?>

	<?= $this->render('_iframe', [
	    'upload' => $upload,
	    'media'  => $media
	]); ?>
</div>



<?php
$this->registerCssFile("@web/css/iframe.css");
$this->registerCssFile("@web/css/media.css");

$this->registerJsFile("@web/js/media.js", ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJs("jQuery('#iframe').media({
    open        : '.open-iframe',
    attachment  : 'input.append-url' 
});", View::POS_END);
?>
