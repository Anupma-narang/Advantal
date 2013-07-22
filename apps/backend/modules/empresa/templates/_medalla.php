<?php if ($empresa->getMedalla() == 'oro'): ?>
    <?php echo 'Oro'; ?>
<?php elseif ($empresa->getMedalla() == 'bronce'): ?>
    <?php echo 'Bronce'; ?>
<?php elseif ($empresa->getMedalla() == 'plata'): ?>
    <?php echo 'Plata'; ?>
<?php elseif ($empresa->getMedalla() == 'sin medalla'): ?>
    <?php echo 'Sin medalla'; ?>
<?php endif; ?>
