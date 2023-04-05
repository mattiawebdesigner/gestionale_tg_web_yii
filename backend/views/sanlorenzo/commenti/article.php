<?php
use yii\helpers\Html;
use backend\models\SnlCommenti;

$this->title = Yii::t('app', 'Articolo: {name}', [
    'name' => $article->titolo,
]);
?>
<div class="crm-sanlorenzo-comments-articles">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="flex gap-1">
        <div>
            <i class="fa-solid fa-comments"></i> <?= backend\models\SnlArticoliCommenti::find()->where(['articolo' => $article->id])->count(); ?>
        </div>
    </div>
    
    <div class="container comments">
        
        
        <?php foreach($comments as $comment): ?>
            <?php $c = (SnlCommenti::find()->where(['id' => $comment->commento])->all())[0]; ?>
            
            <div class="row comment <?= $c->approvato == SnlCommenti::APPROVED ? 'approved' : '' ?> <?= $c->approvato == SnlCommenti::REJECTED ? 'rejected' : '' ?>">
                <?= $c->commento ?>
                
                <div class="actions">
                    <?php if($c->approvato == SnlCommenti::APPROVED): ?>
                        <?= Html::a('<i class="fa-solid fa-xmark"></i>', ['article-comment-reject', 'commento' => $c->id, 'articolo' => $article->id]) ?>
                    <?php elseif($c->approvato == SnlCommenti::REJECTED): ?>
                    <?= Html::a('<i class="fa-solid fa-check"></i>', ['article-comment-approve', 'commento' => $c->id, 'articolo' => $article->id]) ?>
                    <?php else: ?>
                        <?= Html::a('<i class="fa-solid fa-check"></i>', ['article-comment-approve', 'commento' => $c->id, 'articolo' => $article->id]) ?>
                        <?= Html::a('<i class="fa-solid fa-xmark"></i>', ['article-comment-reject', 'commento' => $c->id, 'articolo' => $article->id]) ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
$this->registerCssFile('@web/css/sanlorenzo/sanlorenzo-comments.css', ['depends' => \yii\bootstrap4\BootstrapAsset::class]);