<?php if ($producto->getMedalla() == 'oro'): ?>
    <?php echo 'Oro'; ?>
<?php elseif ($producto->getMedalla() == 'bronce'): ?>
    <?php echo 'Bronce'; ?>
<?php elseif ($producto->getMedalla() == 'plata'): ?>
    <?php echo 'Plata'; ?>
<?php elseif ($producto->getMedalla() == 'sin medalla'): ?>
    <?php echo 'Sin medalla'; ?>
<?php endif; ?>
