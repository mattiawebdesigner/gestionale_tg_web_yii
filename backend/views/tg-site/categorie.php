<?php
$this->title = Yii::t('app', 'Categorie per gli articoli');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tgsite-categories">
    <div class="body-content">
        <h1><?= $this->title ?></h1>
    </div>
    
    <div id="category-manage">
        <div data-success class="alert alert-success d-none-n-i"></div>
        <div data-error class="alert alert-danger d-none-n-i"></div>
        
        <div class="flex flex-row gap-1 flex-wrap">
            <div>
                <h3>Nuova voce di menu</h3>

                    <div class="flex flex-column gap-1">
                        <div class="btn btn-success" data-add>
                            <i class="fa-solid fa-plus"></i> 
                            <?= Yii::t('app', 'Aggiungi una nuova categoria') ?>
                        </div>
                        <div>
                            <input data-name class="form-control" placeholder="<?= Yii::t('app', 'Categoria') ?>" type="text" />
                            <textarea data-description class="form-control" placeholder="<?= Yii::t('app', 'Descrizione della categoria') ?>"></textarea>
                            <div data-error></div>
                        </div>
                    </div>
            </div>

            <div class="drag-and-drop">
                <h3><?= $menu[0]['name']??""?></h3>

                <div id="draggableList" class="draggable-list" data-paste>
                    <div class="action">
                        <div class="btn btn-success" data-save>
                            <i class="fa-solid fa-floppy-disk"></i> Salva
                        </div>
                    </div>
                    <?php foreach($categories as $k => $category): ?>
                        <div class="draggable-item" draggable="true"
                             data-input="<?= htmlspecialchars(
                                json_encode([
                                    'name'          => $category['name'],
                                    'description'   => $category['description']??'',
                                    'taxonomy'      => 'category',
                                    'id'            => $category['id'],
                                ])
                             ); ?>">
                            <?php if($category['id'] <> 1): ?>
                                <div data-delete><i class="fa-solid fa-trash"></i></div>
                            <?php endif; ?>

                            <?= $category['name'] ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$ajaxUrl    = Yii::$app->getUrlManager()->createUrl('tg-site/categories-save-ajax');
$csrfToken  = Yii::$app->request->csrfToken;

$this->registerCssFile("@web/css/tg-site/style.css");
$this->registerCssFile("@web/css/drag-and-drop.css");
$this->registerJsFile('@web/js/tg-site/manageCategory.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJs("
    //Gestione delle voci di menu
    $('#category-manage').manageCategory({
        'ajax-url'  : '$ajaxUrl',
        'csrfToken' : '$csrfToken'
    });
");