<?php
use yii\helpers\Html;
?>
<div class="row slide">
    <div class="col col-sm-12 col-md-12 col-lg-12">
        <table class="table table-responsive-sm table-responsive-lg table-responsive-md table-responsive-xl table-bordered table-sm">
            <tr>
                <td></td>
                <td>
                    <?= Html::a('<i class="fas fa-trash"></i>', ['/gallery/delete-slide', 
                                                                    'id' => $foto->id, 
                                                                    'gallery_id' => $gallery->id], [
                                'class' => 'btn btn-danger btn-small f-right',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Vuoi cancellare la slide?'),
                                    'method' => 'post',
                                ],
                            ]) ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= $form->field($foto, 'id[]')->hiddenInput(['value' => $foto->id])->label(false) ?>
                    <?= $form->field($foto, 'posizione[]')->hiddenInput(['value' => $foto->posizione])->label(false) ?>
                    <div class="img-thumb" style="background-image: url(<?= $foto->url ?>) ">
                        <?= $form->field($foto, 'url[]')->fileInput(['id' => 'input-'.$foto->id])->label("", [
                                'for' => 'input-'.$foto->id
                            
                        ]) ?>
                    </div>
                </td>
                <td>
                    <ul id="tab" class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-conf-<?= $foto->id ?>" role="tab" aria-controls="pills-home" aria-selected="true">
                                <?= Yii::t('app', 'Configurazioni globali') ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-seo-<?= $foto->id ?>" role="tab" aria-controls="pills-profile" aria-selected="false">S.E.O.</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-conf-<?= $foto->id ?>" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div>
                                <?= $form->field($foto, 'descrizione[]')
                                         ->textarea(['maxlength' => true, 'rows' => 3,
                                                    'value' => $foto->descrizione]) ?>
                            </div>
                            <div>
                                <?= $form->field($foto, 'open[]')->dropDownList(['yes' => 'Si', 'no' => 'No']) ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-seo-<?= $foto->id ?>" 
                             role="tabpanel" aria-labelledby="pills-profile-tab">
                                 <?= $form->field($foto, 'title_text[]')->textInput(['value' => $foto->title_text]); ?>
                                 <?= $form->field($foto, 'alt_text[]')->textInput(['value' => $foto->alt_text]); ?>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>