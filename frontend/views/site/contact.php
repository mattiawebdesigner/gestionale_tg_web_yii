<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\bootstrap4\Html;

$this->title = Yii::t('app', 'Contattaci');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <table class="table">
      <thead class="thead-light">
        <tr>
          <th scope="col">Nominativo</th>
          <th scope="col">Email</th>
          <th scope="col">Telefono</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Teatralmente Gioia</td>
          <td><?= Html::mailto("info@teatralmentegioia.it", "info@teatralmentegioia.it")?></td>
          <td><a hred="calto: 3285712248">328 571 2248</a></td>
        </tr>
        
        <tr>
          <td>Presidente</td>
          <td><?= Html::mailto("presidente@teatralmentegioia.it", "presidente@teatralmentegioia.it")?></td>
          <td><a hred="calto: 3348768832">334 876 8832</a></td>
        </tr>
        
        <tr>
          <td>Segreteria</td>
          <td><?= Html::mailto("segreteria@teatralmentegioia.it", "segreteria@teatralmentegioia.it")?></td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <?php /*<div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>*/ ?>

</div>
