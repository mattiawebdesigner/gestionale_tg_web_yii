<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\IltSponsor;

$listData = $options = [];
    $options['options'] = [];
    $i = 0;
    foreach(ArrayHelper::map(
                            IltSponsor::find()->asArray()->all(), 'id', 'sponsor'
                    ) as $k => $item) {
        $listData[$k] = $item;
        $options['options'][$k] = ['data-img' => 'https://www.teatralmentegioia.it/crm/backend/web/iloveteatro/media_uploads/2027d06c9cab1b662246fbf31660f7bb25db3e3fcb0e31483890a9d8f3e7e6d5.jpg'];
        $i ++;
    }
?>
<div id="iscrizioni-add">
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="actions">
        <?= Html::a('<i class="fas fa-table"></i>', ['sponsor'], ['class' => 'btn btn-warning']) ?>
        <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?> 
    </div>
    
    <select name="sponsor" data-placeholder="Select a country" data-dynamic-select class="form-control">
        <?php foreach(IltSponsor::find()->asArray()->all() as $k => $item): ?>
            <option value="<?= $item['id'] ?>" data-img="<?= $item['immagine'] ?>"><?= $item['sponsor'] ?></option>
        <?php endforeach; ?>
    </select>
    
    <div>
        <?= $form->field($model, 'festival')->hiddenInput(['value' => $festival->id])->label(false) ?>
   </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerJsFile('@web/js/select.js', ['depends' => yii\web\JqueryAsset::class]);
$this->registerCssFile('@web/css/select.css');