<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-tab1-tab" 
           data-toggle="tab" href="#nav-tab-approvati" role="tab" 
           aria-controls="nav-tab1" aria-selected="true">
                <?= Yii::t('app', 'Commenti approvati') ?>
        </a>
        <a class="nav-item nav-link" id="nav-tab2-tab" data-toggle="tab" 
           href="#nav-tab-da-approvare" role="tab" aria-controls="nav-tab-da-approvare" 
           aria-selected="false">
            <?= Yii::t('app', 'Commenti da approvare') ?>
        </a>
        <a class="nav-item nav-link" id="nav-tab3-tab" 
           data-toggle="tab" href="#nav-tab-rifiutati" role="tab" 
           aria-controls="nav-tab-rifiutati" aria-selected="false">
            <?= Yii::t('app', 'Commenti rifiutati') ?>
        </a>
    </div>
</nav>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane p-4 fade show active" id="nav-tab-approvati" role="tabpanel" aria-labelledby="nav-tab-approvati-tab">
        <?= $this->render('comment_page/_commentApproved', [
            'commentApproved' => $commentApproved,
        ]) ?>
    </div>
    <div class="tab-pane p-4 fade" id="nav-tab-da-approvare" role="tabpanel" aria-labelledby="nav-tab-da-approvaretab">
       <?= $this->render('comment_page/_commentToBeApproved', [
            'commentToBeApproved' => $commentToBeApproved,
        ]) ?>
    </div>
    <div class="tab-pane p-4 fade" id="nav-tab-rifiutati" role="tabpanel" aria-labelledby="nav-tab-rifiutati-tab">
       <?= $this->render('comment_page/_commentReject', [
            'commentReject' => $commentReject,
        ]) ?>
    </div>
</div>