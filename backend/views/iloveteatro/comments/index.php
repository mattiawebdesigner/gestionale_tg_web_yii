<?php
use yii\helpers\Html;

$title = Yii::t('app', 'Commenti');
$this->title = $title . " | I Love Teatro";
?>
<div class="comments-index">
    <h1><?= Html::encode($title) ?></h1>
    
    <nav>
        <div class="nav nav-tabs" id="ilove-tabs" role="tablist">
            <a class="nav-item nav-link active" id="nav-tab1-tab" 
               data-toggle="tab" href="#nav-tab-comments-articles" role="tab" 
               aria-controls="nav-tab1" aria-selected="true">
                    <?= Yii::t('app', 'Commenti degli articoli') ?>
            </a>
            <a class="nav-item nav-link" id="nav-tab2-tab" data-toggle="tab" 
               href="#nav-tab-comments-album" role="tab" aria-controls="nav-tab-da-approvare" 
               aria-selected="false">
                <?= Yii::t('app', 'Commenti degli album') ?>
            </a>
            <a class="nav-item nav-link" id="nav-tab3-tab" 
               data-toggle="tab" href="#nav-tab-comments-photoes" role="tab" 
               aria-controls="nav-tab-rifiutati" aria-selected="false">
                <?= Yii::t('app', 'Commenti delle foto') ?>
            </a>
        </div>
    </nav>

    <div class="tab-content" id="ilove-tabs-content">
    <div class="tab-pane p-4 fade show active" id="nav-tab-comments-articles" role="tabpanel" aria-labelledby="nav-tab-approvati-tab">
        <?= $this->render('_commentArticles', [
            'commentApproved'       => $commentArticlesApproved,
            'commentToBeApproved'   => $commentArticlesToBeApproved,
            'commentReject'         => $commentArticlesReject,
        ]) ?>
    </div>
    <div class="tab-pane p-4 fade" id="nav-tab-comments-album" role="tabpanel" aria-labelledby="nav-tab-da-approvaretab">
        <?= $this->render('_commentAlbum', [
            'commentApproved'       => $commentAlbumsApproved,
            'commentToBeApproved'   => $commentAlbumsToBeApproved,
            'commentReject'         => $commentAlbumsReject,
        ]) ?>
    </div>
    <div class="tab-pane p-4 fade" id="nav-tab-comments-photoes" role="tabpanel" aria-labelledby="nav-tab-rifiutati-tab">
        <?= $this->render('_commentFoto', [
            'commentApproved'       => $commentFotoApproved,
            'commentToBeApproved'   => $commentFotoToBeApproved,
            'commentReject'         => $commentFotoReject,
        ]) ?>
    </div>
    </div>

</div>

<div id="show-comment" data-paste-comment>
    <i class="fas fa-times" data-exit></i>

    <div class="content" data-content>
        
    </div>
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/comments.css');
$this->registerCssFile('@web/css/tabs.css');
$this->registerCssFile('@web/css/iloveteatro/tabs.css');
$this->registerJsFile('@web/js/preview_comments.js', ['depends' => \yii\web\JqueryAsset::class]);
foreach($commentArticlesApproved as $comment){
    $this->registerJs('
        jQuery(".comment-'.$comment->id.'").preview_comments();
    ');
}
foreach($commentAlbumsApproved as $comment){
    $this->registerJs('
        jQuery(".comment-'.$comment->id.'").preview_comments();
    ');
}
foreach($commentFotoApproved as $comment){
    $this->registerJs('
        jQuery(".comment-'.$comment->id.'").preview_comments();
    ');
}

foreach($commentArticlesToBeApproved as $comment){
    $this->registerJs('
        jQuery(".comment-'.$comment->id.'").preview_comments();
    ');
}
foreach($commentAlbumsToBeApproved as $comment){
    $this->registerJs('
        jQuery(".comment-'.$comment->id.'").preview_comments();
    ');
}
foreach($commentFotoToBeApproved as $comment){
    $this->registerJs('
        jQuery(".comment-'.$comment->id.'").preview_comments();
    ');
}

foreach($commentArticlesReject as $comment){
    $this->registerJs('
        jQuery(".comment-'.$comment->id.'").preview_comments();
    ');
}
foreach($commentAlbumsReject as $comment){
    $this->registerJs('
        jQuery(".comment-'.$comment->id.'").preview_comments();
    ');
}
foreach($commentFotoReject as $comment){
    $this->registerJs('
        jQuery(".comment-'.$comment->id.'").preview_comments();
    ');
}