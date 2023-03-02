<?php
use yii\helpers\Html;
?>
<div class="comment-container comment-approved flex">
    
    <?php if(sizeof($commentToBeApproved) == 0): ?>
    <p class="alert alert-info">
        <?= Yii::t('app', 'Non ci sono commenti da approvare') ?>
    </p>
    <?php endif; ?>
    
    <?php foreach($commentToBeApproved as $comment) : ?>
    <div class="comment comment-<?= $comment->id ?>">
        <div class="title"><?= $comment->articolos[0]->titolo ?></div>
        <div data-content class="content"><?= $comment->commento ?></div>
        <div class="action">
            <div class="btn-circle">
                <?= Html::a('<i class="fa-solid fa-check-circle rotate-2 approved"></i>', ['comment-approve', 'id'=>$comment->id]) ?>
            </div>
            <div class="btn-circle">
                <?= Html::a('<i class="fa-solid fa-trash-alt rotate-2 reject"></i>', ['comment-reject', 'id'=>$comment->id]) ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    
</div>