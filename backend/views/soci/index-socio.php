<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SociSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Soci');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soci-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 
    <div class="tabs">
      <div class="row">
        <div class="col-4 col-md-3">
            <div class="nav nav-tabs nav-tabs-vertical" id="nav-vertical-tab" role="tablist" aria-orientation="vertical">
                <a class="vertical-tab nav-link active" 
                       id="nav-vertical-tab1-tab" 
                       data-toggle="tab" 
                       href="#nav-vertical-tab-soci" 
                       role="tab" 
                       aria-controls="nav-vertical-soci" 
                       aria-selected="true"><?= Yii::t('app', 'Soci') ?></a>
                
                <a class="vertical-tab nav-link" 
                       id="nav-vertical-tab1-tab" 
                       data-toggle="tab" 
                       href="#nav-vertical-tab-soci-sostenitori" 
                       role="tab" 
                       aria-controls="nav-vertical-soci" 
                       aria-selected="true"><?= Yii::t('app', 'Soci sostenitori') ?></a>
            </div>
        </div>
        <div class="col-8 col-md-9">
          <div class="tab-content" id="nav-vertical-tabContent">
                <div class="tab-pane p-3 fade show active" 
                         id="nav-vertical-tab-soci" 
                         role="tabpanel" 
                         aria-labelledby="nav-vertical-tab1-tab">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'cognome',
                            'nome',

                        ],
                    ]); ?>
                </div>
                
                <div class="tab-pane p-3 fade" 
                         id="nav-vertical-tab-soci-sostenitori" 
                         role="tabpanel" 
                         aria-labelledby="nav-vertical-tab1-tab">
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderSupporter,
                        'filterModel' => $searchModelSupporter,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'cognome',
                            'nome',

                        ],
                    ]); ?>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>


<?php
$this->registerCssFile("@web/css/fontawesome-free-6.0.0-beta2-web/css/all.min.css");
$this->registerCssFile('@web/css/pagination.css');
$this->registerCssFile('@web/css/tabs.css');