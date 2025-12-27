<?php
use yii\helpers\Html;
use backend\models\Utenti;
use backend\models\Posts;

$this->title = Yii::t('app', 'Articoli');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestione sito'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tgsite-categories">
    <div class="body-content">
        <h1><?= $this->title ?></h1>
    </div>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><?= Yii::t('app', 'Titolo') ?></th>
                <th class="column-author" scope="col"><?= Yii::t('app', 'Autore') ?></th>
                <th class="column-categories" scope="col"><?= Yii::t('app', 'Categorie') ?></th>
                <th class="column-comments" scope="col"><i class="fa-solid fa-message"></i></th>
                <th class="column-data" scope="col"><?= Yii::t('app', 'Data') ?></th>
            </tr>
        </thead>
        
        <tbody>
            <?php foreach($articles as $article): ?>
            <tr>
                <td scope="row">
                    <?= Html::a(
                        $article['post_title'],
                        ['tg-site/articolo', 'id' => $article['id']]
                    ) ?>
                </td>
                <td class="column-author">
                    <?= Html::a(
                        Utenti::find($article['id'])->one()->nome . " ".
                        Utenti::find($article['id'])->one()->cognome,
                        ['utenti/view', 'id' => Utenti::find($article['id'])->one()->id]
                    ); ?>
                </td>
                <td class="column-categories">Otto</td>
                <td class="column-comments">
                    <div class="d-inline-block">
                        <span class="comment-count-approved" aria-hidden="true">1</span>
                    </div>
                </td>
                <td class="column-data">
                    <div>
                        <?php 
                        switch($article->post_status){
                            case Posts::STATUS_PUBLISHED:
                                echo Yii::t('app', 'Pubblicato');
                                break;
                        }
                        ?>
                    </div>
                    <div><?= date("d/m/Y H:i", strtotime($article->post_date)) ?></div>
                </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
    </table>
    
    <pre>
        <?php
        print_r($articles);
        ?>
    </pre>
    
</div>

<?php
$this->registerCssFile("@web/css/tg-site/style.css");