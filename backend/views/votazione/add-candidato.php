<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Aggiungi un nuovo candidato');

$this->params['breadcrumbs'][] = ['label' => "Tutte le votazioni", 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Votazioni: {$model->anno}", 'url' => ['view', 'id' => $model->id, 'anno' => $model->anno]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Candida'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php foreach($soci as $socio): ?>
        <div>
            <?php $checked = false; 
            foreach($candidati as $candidato){
                if($candidato->socio_id === $socio['id']){
                    $checked = true;
                    break;
                }
            } ?>
            
            <?= Html::input("checkbox", "candidati[]", $socio['id'], ['checked' => $checked]) ?>
            <?= $socio['cognome'] ?>
            <?= $socio['nome'] ?>
        </div>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Candida'), ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>