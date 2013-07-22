<?php if ($reward_log->getCash()): ?>
  <?php echo $sf_user->getMoneyInFormat($reward_log->getCash()) . ' €'; ?>
<?php endif; ?>