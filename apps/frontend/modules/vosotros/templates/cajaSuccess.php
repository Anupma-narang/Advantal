<?php if ($status == 200): ?>
    <span class="negrita rojo_marron"><?php echo __('Caja: ') . $sf_user->getMoneyInFormat($sf_user->getGuardUser()->getProfile()->getMoney()) ?>&euro;</span><br />
    <span class="negrita rojo_marron"><?php echo __('Cajaacumulada: ') . $sf_user->getMoneyInFormat($sf_user->getGuardUser()->getProfile()->getMoneySum()) ?>&euro;</span>
<?php else: ?>
    <?php echo $status; ?>
<?php endif; ?>
