<?php
use yii\helpers\Html;
?>
<div class="comment-container comment-reject flex">
    
    <?php if(sizeof($commentReject) == 0): ?>
    <p class="alert alert-info">
        <?= Yii::t('app', 'Non ci sono commenti rifiutati') ?>
    </p>
    <?php else: ?>
        <?php foreach($commentReject as $comment) : ?>
        <div class="comment comment-<?= $comment->id ?>">
            <?php if(isset($comment->articolos[0])) : ?>
            <div class="title"><?= $comment->articolos[0]->titolo ?></div>
            <?php endif; ?>
            <div data-content class="content"><?= $comment->commento ?></div>
            <div class="action">
                <div class="btn-circle">
                    <?= Html::a('<i class="fa-solid fa-check-circle rotate-2 approved"></i>', ['comment-approve', 'id'=>$comment->id]) ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
    
    
    
</div>