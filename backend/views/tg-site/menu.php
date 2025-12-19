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
                
                <div class="flex gap-1" data-item-menu-info>
                    <select class="form-control" data-change name="">
                        <?php foreach($menu_type['_menu_item_type'] as $type => $value): ?>
                            <option value="<?= $type ?>" data-change-target-id="<?= $type ?>"><?= $value['text'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <?php foreach($menu_type['_menu_item_type'] as $type => $value): ?>
                        <?php if(explode("|", $value['type'])[0]==="url"): ?>
                            <input type="url" class="form-control" pattern="https://.*" required data-change-id="<?= $type ?>" />
                        <?php elseif(explode("|", $value['type'])[0]==="dropdown"): ?>
                            <select class="form-control" data-change-id="<?= $type ?>" name=""><?php foreach($posts as $post): ?>
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
                <div class="action">
                    <div class="btn btn-success" data-menu-save>
                        <i class="fa-solid fa-floppy-disk"></i> Salva
                    </div>
                </div>
                <?php foreach($menu as $k => $menu_item): ?>
                <div class="draggable-item" draggable="true"
                     data-input="<?= htmlspecialchars(
                        json_encode([
                            'target'            => $menu_item['key_value']['meta_value'][array_search("_menu_item_target", $menu_item['key_value']['meta_key'])],
                            'post_title'        => $menu_item['post_title'],
                            'item_object'       => $menu_item['post_title'],
                            'item_object_id'    => $menu_item['post_title'],
                        ])
                    ) ?>">
                    <?= $menu_item['post_title'] ?>

                    <div class="info">
                        <div class="close">
                            <i class="fa-solid fa-x"></i>
                        </div>
                    </div>
                    
                    <div style="font-size: small;">
                        <?php
                        switch($menu_item['key_value']['meta_key'][0]){
                            case "custom":
                                echo "Link personalizzato";
                                break;
                            case "post_type":
                                echo "Articolo specifico";
                                break;
                        }
                        ?>
                    </div>
                </div>
                
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <pre>
        <?php print_r($menu) ?> 
        <?php print_r($posts) ?> 
    </pre>
</div>

<?php
$menu_type  = json_encode($menu_type);
$ajaxUrl    = Yii::$app->getUrlManager()->createUrl('tg-site/menu-save-ajax');
$csrfToken  = Yii::$app->request->csrfToken;

$this->registerCssFile("@web/css/tg-site/style.css");
$this->registerCssFile("@web/css/drag-and-drop.css");
$this->registerJsFile('@web/js/showItem.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/tg-site/menuCreate.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJs("
    
    $('#menu-create').menuCreate({
        'menu-type' : $menu_type,
        'ajax-url'  : '$ajaxUrl',
        'csrfToken' : '$csrfToken'
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