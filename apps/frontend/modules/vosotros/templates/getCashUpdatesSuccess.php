<?php if ($is_points): ?>
    <span class="negrita azul"><?php echo __('Puntos acumulados: ') . $sf_user->getMoneyInFormat($profile->getAccumulatedPoints()) ?></span><br/>
    <span class="negrita naranja"><?php echo __('Puntos canjeables: ') . $sf_user->getMoneyInFormat($profile->getChangePoints()) ?></span><br />
<?php else: ?>
    <span class="negrita rojo_marron"> <?php echo __('Caja:') . $sf_user->getMoneyInFormat($profile->getMoney()) . '€' ?> </span><br>
    <span class="negrita rojo_marron"> <?php echo __('Caja acumulada:') . $sf_user->getMoneyInFormat($profile->getMoneySum()) . '€' ?> </span>
<?php endif; ?>
