<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Album fotografici');
?>
<div id="album" class="slideshow-album">
    <h1><i class="fa-solid fa-images"></i> <?= Html::encode($this->title) ?></h1>
    
    <div class="container">
        <div class="row">
            <?php foreach($album as $a): ?>
                <div class="col col-sm-3 preview" style="background-image: url('<?= ((count($a->fotos)<>0)? $a->fotos[0]->url:'') ?>');">
                    
                    <?= Html::a('', ['/iloveteatro/album-delete', 'id' => $a->id],[
                        'data' => [
                            'confirm' => Yii::t('app', 'Sei sicuro di voler cancellare questo articolo?'),
                            'method' => 'post',
                        ],
                        'class' => 'trash fas fa-trash-alt btn btn-danger floating-button top-right-1 plus-circle-btn-2'
                    ])  ?>
                    
                    <?= Html::a(<<<A
                        <div class="title">$a->nome</div>
A, ['album-update', 'id' => $a->id]) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    
    <?= Html::a(<<<A
        <div class="floating-button plus-circle-btn bottom-right-1 btn btn-success btn-rotate">
            <i class="fas fa-plus"></i>
        </div>
A, ['create-album']) ?>
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/album.css');