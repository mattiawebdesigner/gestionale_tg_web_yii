<?php
return ['label' => 'Segreteria', 'url' => '#', 'items' => [
            //Soci
            "<div class='menu-item'>",
                ['label' =>  Yii::t('app', 'I Soci')],
                ['label' =>  Yii::t('app', 'Anno Sociale'), 'url' => ['/anno-sociale/index']],
                ['label' =>  Yii::t('app', 'Soci suddivisi per anno'), 'url' => ['/soci/index']],
                ['label' =>  Yii::t('app', 'Storico dei soci'), 'url' => ['/soci/all']],
                ['label' =>  Yii::t('app', 'Soci in corso di validità'), 'url' => ['/soci/print-show']],
                '<hr />',

                //Consiglio direttivo
                ['label' => Yii::t('app', 'Consiglio Direttivo')],
                ['label' => Yii::t('app', 'Componenti consiglio direttivo'), 'url' => ['/direttivo/index']],
                '<hr />',            

                //Albo d'oro
                ['label' => 'Albo D\'Oro'],
                ['label' => Yii::t('app', 'Nuovo Componente'), 'url' => ['/nominativo/create']],
                ['label' => Yii::t('app', 'I Componenti'), 'url' => ['/nominativo/index']],
            "</div>",

            //Rendiconti
            "<div class='menu-item'>",
                ['label' => Yii::t('app', 'Rendicontazioni')],
                ['label' => Yii::t('app', 'Le rendicontazioni'), 'url' => ['/rendiconto/index']],
                ['label' => Yii::t('app', 'Nuova rendicontazione'), 'url' => ['/rendiconto/create']],
                '<hr />',

                //Verbali
                ['label' => Yii::t('app', 'Gestione dei verbali')],
                ['label' => Yii::t('app', 'Le Convocazioni'), 'url' => ['/convocazioni/index']],
                ['label' => Yii::t('app', 'I verbali'), 'url' => ['/verbali/index']],
                '<hr />',

                //Documentazione
                ['label' => Yii::t('app', 'Documenti')],
                ['label' => Yii::t('app', 'Documentazione'), 'url' => ['/documentazione/index']],
            "</div>",

            //Email
            /*['label' => Yii::t('app', 'Gestione mail')],

            ['label' => Yii::t('app', 'Nuova mail'), 'url' => ['/email/create']],

            '<hr />',*/

            //Votazioni
            "<div class='menu-item'>",
                ['label' => Yii::t('app', 'Votazioni')],
                ['label' => Yii::t('app', 'Soci con diritto di voto'), 'url' => ['/votazione/elenco-votazioni']],
                ['label' => Yii::t('app', 'Gestione delle votazioni'), 'url' => ['/votazione/gestione-votazioni']],
            "</div>",
        ]];