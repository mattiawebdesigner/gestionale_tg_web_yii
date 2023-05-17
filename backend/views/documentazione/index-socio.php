<?php
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentazioneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documentazione');
$this->params['breadcrumbs'][] = $this->title;
$id = 1;
?>
<?= $this->render("index", [
    'cartelle'  => $cartelle,
    'documenti' => $documenti,
    'socio'     => true,
]) ?>