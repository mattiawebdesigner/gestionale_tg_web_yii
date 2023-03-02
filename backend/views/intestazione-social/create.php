<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\IntestazioneSocial */

$this->title = Yii::t('app', 'Create Intestazione Social');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Intestazione Socials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intestazione-social-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
