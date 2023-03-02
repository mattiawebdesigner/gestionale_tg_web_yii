<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Utenti */

$this->title = Yii::t('app', 'Nuovo utente');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Utenti'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utenti-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= Html::a('<i class="fas fa-users"></i> '.Yii::t('app', 'Crea dai soci'), ['/soci/select', 'id' => $model->id], ['class' => 'btn btn-success']) ?>

   	<div id="soci" class="">
   		
   	</div>
   	
    <?= $this->render('_form', [
        'model' => $model,
        'ruoli' => $ruoli,
        'auth_assignment' => $auth_assignment,
    ]) ?>

</div>
