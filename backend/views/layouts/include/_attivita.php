<?php

return ['label' => 'Attivita', 'url' => ['/attivita/index'], 'items' => [
    "<div class='menu-item'>",
        ['label' => Yii::t('app', 'Tutte le attività'), 'url' => ['/attivita/index']],
        ['label' => Yii::t('app', 'Elenco prenotazioni'), 'url' => ['/attivita/reservations']],
    "</div>"
]];