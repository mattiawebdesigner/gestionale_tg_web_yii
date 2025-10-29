<?php
/********************************************
 * Display day and hour of the turn
********************************************/
?>
<div class="date"><i class="fas fa-calendar-alt"></i>
    <?php if($n_of_turns == 1):?>
        <?= date("d-m-Y H:i", strtotime($attivita->data_attivita)) ?>
    <?php else: ?>
        <?= date("d-m-Y H:i", strtotime($attivita->parametri->dates->days[0]->date)) ?>
    <?php endif; ?>
</div>