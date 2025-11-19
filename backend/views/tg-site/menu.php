<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Menu - Gestione del sito');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tgsite-menu">
    <h1><?= $this->title ?></h1>
    
    <div id="menu-create" class="flex flex-row gap-1 flex-wrap">
        <div>
            <h3>Nuova voce di menu</h3>
            
            <div class="flex flex-column gap-1">
                <div class="btn btn-success" data-item-menu-add>
                    <i class="fa-solid fa-plus"></i> 
                    <?= Yii::t('app', 'Aggiungi nuova voce di menu') ?>
                </div>
                <div>
                    <input data-item-menu-name class="form-control" placeholder="<?= Yii::t('app', 'Voce di menu') ?>" type="text" />
                    <div data-item-menu-error></div>
                </div>
                
                <div data-item-menu-info>
                    <select class="form-control" name="">
                        <?php foreach($menu_type['_menu_item_type'] as $type => $value): ?>
                        <option value="<?= $type ?>"><?= $value['text'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <?php foreach($menu_type['_menu_item_type'] as $type => $value): ?>
                        <?php if(explode("|", $value['type'])[0]==="url"): ?>
                        <input type="url" pattern="https://.*" required />
                        <?php elseif(explode("|", $value['type'])[0]==="dropdown"): ?>
                        <select class="form-control" name="">
                            <?php foreach($posts as $post): ?>
                            <option value="<?= $post['id'] ?>"><?= $post['post_title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <div class="drag-and-drop">
            <h3><?= $menu[0]['name']??""?></h3>
            
            <div id="draggableList" class="draggable-list" data-menu-item-paste>
                <?php foreach($menu as $menu_item): ?>
                <div class="draggable-item" draggable="true">
                    <?= $menu_item['post_title'] ?>

                    <div class="info">
                        <div class="close">
                            <i class="fa-solid fa-x"></i>
                        </div>

                        <?php foreach($menu_item['key_value']['meta_key'] as $key => $meta_key): ?>
                        <div class="<?= $meta_key ?>">
                            
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <pre>
        <?php print_r($menu_type) ?> 
        <?php print_r($posts) ?> 
    </pre>
</div>

<?php
$this->registerCssFile("@web/css/tg-site/style.css");
$this->registerCssFile("@web/css/drag-and-drop.css");
$this->registerJsFile('@web/js/showItem.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/tg-site/menuCreate.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJs("
    
    $('#menu-create').menuCreate({
        'menu-type': {}
    });
    
    //Apro/Chiudo il box info per un menu item
    /*jQuery(document).ready(()=>{
        jQuery('.draggable-item').click((e)=>{
            //jQuery('.info').hide();
            jQuery('.info', e.target).show();
        });
        
        jQuery('.close').click((e)=>{
            jQuery(e.target).parents('.info').hide();
        });
    });*/
    
    
    //Drag and drop with javascript
    /*const list = document.getElementById('draggableList');

    document.querySelectorAll('.draggable-item').forEach(item => {
        item.addEventListener('dragstart', e => {
            item.classList.add('dragging');
            e.dataTransfer.setData('text/plain', '');
        });
        item.addEventListener('dragend', () => item.classList.remove('dragging'));
    });

    list.addEventListener('dragover', e => {
        e.preventDefault();
        const draggingItem = document.querySelector('.dragging');
        const siblings = [...list.querySelectorAll('.draggable-item:not(.dragging)')];
        const nextSibling = siblings.find(sibling => {
            return e.clientY < sibling.getBoundingClientRect().top + sibling.offsetHeight / 2;
        });
        list.insertBefore(draggingItem, nextSibling);
    });*/

");