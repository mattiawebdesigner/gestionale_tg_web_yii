<?php

    $menuItemsAll = [
        //Magazzino
        include_once 'include/_magazzino.php',
        
        //Segreteria
        include_once 'include/_segreteria.php',
        
        //Gestione Attività
        include_once 'include/_attivita.php',
        
        //Utenti
        include_once 'include/_utenti.php',
        
        //Foto e Video
        include_once 'include/_gallery.php',
        
        //Gestione dei media
        ['label' => 'Media', 'url' => ['/media/index']],
    ];
    ?>