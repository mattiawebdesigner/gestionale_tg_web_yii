<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$title = Yii::t('app', 'Impostazioni');
$this->title = $title . " | I Love Teatro";
?>
<h1><?= Html::encode($title) ?></h1>

<p class="alert alert alert-warning">
    <?= Yii::t('app', 'Al momento questa sezione non è completamente attiva') ?>
</p>


<?php
/*$v = [
    ['nome' => 'nome', 'tipo' => 'string'],
    ['nome' => 'link', 'tipo' => 'string'],
];
echo json_encode($v);*/
?>

<div class="settings">
    <?php $form = ActiveForm::begin([
        'options' => [
            "data-form" => "comments",
        ]
    ]); ?>
        <div class="actions">
            <?= Html::submitButton('<i class="fa-solid fa-floppy-disk"></i> '.Yii::t('app', 'Salva'), ['class' => 'salva btn btn-iloveteatro']) ?>
        </div>
    
    
        <?php foreach($impostazioni as $i): ?>
            <div class="setting-<?= $i->impostazione ?>">
                <h4 class="text-underline"><?= ucwords($i->impostazione) ?></h4>
                
                <div class="container">
                <?php 
                $j_d = json_decode($i->valore);
                $struttura = json_decode($i->struttura);
                $nOfRow = 0;
                foreach ($j_d as $k => $v) : ?>
                    <div>
                        #<?= ++ $nOfRow ?>
                        <?php foreach($struttura as $s) : ?>
                    
                            <?php $n = $s->nome; ?>
                    
                            <input type="text" name="impostazione[<?= $i->impostazione ?>][<?= $k ?>][<?= $s->nome ?>]?>" placeholder="<?= $s->nome ?>" value="<?= $v->$n ?>" class="form-control" />
                        <?php endforeach; ?>
                    </div>
                    
                <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/settings.css');