<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-tab1-foto-approved" 
           data-toggle="tab" href="#nav-tab-foto-approved" role="tab" 
           aria-controls="nav-tab1" aria-selected="true">
                <?= Yii::t('app', 'Commenti approvati') ?>
        </a>
        <a class="nav-item nav-link" id="nav-tab2-foto-to-be-approved" data-toggle="tab" 
           href="#nav-tab-foto-to-be-approved" role="tab" aria-controls="nav-tab-da-approvare" 
           aria-selected="false">
            <?= Yii::t('app', 'Commenti da approvare') ?>
        </a>
        <a class="nav-item nav-link" id="nav-tab3-foto-reject" 
           data-toggle="tab" href="#nav-tab-foto-reject" role="tab" 
           aria-controls="nav-tab-rifiutati" aria-selected="false">
            <?= Yii::t('app', 'Commenti rifiutati') ?>
        </a>
    </div>
</nav>

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane p-4 fade show active" id="nav-tab-foto-approved" role="tabpanel" aria-labelledby="nav-tab-approvati-tab">
        <?= $this->render('comment_page/_commentApproved', [
            'commentApproved' => $commentApproved,
        ]) ?>
    </div>
    <div class="tab-pane p-4 fade" id="nav-tab-foto-to-be-approved" role="tabpanel" aria-labelledby="nav-tab-da-approvaretab">
       <?= $this->render('comment_page/_commentToBeApproved', [
            'commentToBeApproved' => $commentToBeApproved,
        ]) ?>
    </div>
    <div class="tab-pane p-4 fade" id="nav-tab-foto-reject" role="tabpanel" aria-labelledby="nav-tab-rifiutati-tab">
       <?= $this->render('comment_page/_commentReject', [
            'commentReject' => $commentReject,
        ]) ?>
    </div>
</div>