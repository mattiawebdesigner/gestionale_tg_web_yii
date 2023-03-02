<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\grid\ActionColumn;
use backend\models\Soci;
use yii\helpers\Url;

$this->title = $model->oggetto;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Convocazione: {prot}', [
    'prot' => $numero_protocollo
]),                                     'url' => ['view', 'numero_protocollo' => $numero_protocollo]];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<h1><?= Html::encode($this->title) ?></h1>
<h3>Prot.: <?= Html::encode($numero_protocollo) ?></h3>

	
    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'sendEmailForm'
        ]
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-paper-plane"></i> '.Yii::t('app', 'Invia la convocazione'), 
                ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <?= GridView::widget([
        'dataProvider' => $partnerDataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'contentOptions'=>[ 'style'=>'width: 50px'],
                'name' => 'checked',
                'checkboxOptions'=> function($model, $key, $index, $column) {
                    return [
                        "value" => $model->id,
                        'onchange' => '
                            var id = $(this).val();
                            var input = $("#sendEmailForm input[value=\""+id+"\"]");
                            if(input.val() === undefined){
                                //Append data
                                $("#sendEmailForm").append("<input type=\"hidden\" name=\"id[]\" value=\""+ id +"\" />");
                            }else{
                                $(input).remove();
                            }
                            
                            
                            
                        '
                    ];
                }
            ],
            
            'cognome',
            'nome',
            'email:email',
            //'indirizzo',
            //'data_registrazione',
            //'data_di_nascita',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php
$this->registerCssFile('@web/css/pagination.css');