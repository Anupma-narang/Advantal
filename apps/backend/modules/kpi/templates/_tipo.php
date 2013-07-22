<?php if ($kpi->getTipo() == "empresa"): ?>
    <?php echo "Empresa/Entidad"; ?>
<?php elseif ($kpi->getTipo() == "producto"): ?>
    <?php echo "Producto"; ?>
<?php else: ?>
    <?php echo $kpi->getTipo(); ?>
<?php endif; ?>

