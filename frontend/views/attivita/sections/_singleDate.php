<?php
/********************************************
 * Display day and hour of the turn
********************************************/
?>
<div class="date"><i class="fas fa-calendar-alt"></i>
    <?= date("d-m-Y H:i", strtotime($attivita->parametri->dates->days[$turnCorrect<0?0:$turnCorrect]->date)) ?>
</div>