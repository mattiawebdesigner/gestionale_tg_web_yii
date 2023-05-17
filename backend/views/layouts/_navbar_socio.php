<?php
$menuItemsSocio = [
    ['label' => Yii::t('app', 'Area socio'), 'url' => '#', 'items' => [
            //Soci
            ['label' => Yii::t('app', 'Trasparenza'), 'url' => ['/rendiconto/socio-view']],
            '<hr />',
            ['label' => Yii::t('app', 'Convocazioni e verbali'), 'url' => ['/verbali/index-socio']],
            '<hr />',
            ['label' => Yii::t('app', 'I Soci'), 'url' => ['/soci/index-socio']],
            '<hr />',
            ['label' => Yii::t('app', 'Documenti'), 'url' => ['/documentazione/socio-view']],
            '<hr />',
            ['label' => Yii::t('app', 'Il Materiale'), 'url' => ['/prodotto/index-socio']],
            '<hr />',
            ['label' => Yii::t('app', 'Votazioni'), 'url' => ['/votazione/index-socio']],
        ]
    ],
];