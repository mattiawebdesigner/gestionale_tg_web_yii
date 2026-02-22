<?php
return ['label' => 'Utenti', 'url' => '#', 'items' => [
    "<div class='menu-item'>",
        ['label' => Yii::t('app', 'Nuovo utente'), 'url' => ['/utenti/create']],
        ['label' => Yii::t('app', 'Tutti gli utenti'), 'url' => ['/utenti/index']],
    "</div>"
]];