<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\IntestazioneSocial */

$this->title = Yii::t('app', 'Update Intestazione Social: {name}', [
    'name' => $model->id_intestazione,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Intestazione Socials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_intestazione, 'url' => ['view', 'id_intestazione' => $model->id_intestazione, 'id_social' => $model->id_social]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="intestazione-social-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
