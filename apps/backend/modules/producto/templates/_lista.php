<?php if ($producto->getLista() == "lb"): ?>
    <?php echo __('Blanca', array(), 'messages'); ?>
<?php elseif ($producto->getLista() == "ln"): ?>
    <?php echo __('Negra', array(), 'messages'); ?>
<?php else: ?>
    <?php echo __('Ninguna', array(), 'messages'); ?>
<?php endif; ?>
