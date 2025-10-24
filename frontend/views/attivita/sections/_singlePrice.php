<?php if($attivita->pagamento == "yes") : ?>
    <div class="date"><i class="fas fa-euro-sign"></i> <?= $attivita->parametri->dates->days[0]->place ?></div>
<?php endif; ?>