<?php if (!$contribucion->getEmpresaCity()): ?>
    <?php echo $contribucion->getConcurso()->getStates(); ?>
<?php else: ?>
    <?php echo $contribucion->getEmpresaCity(); ?>
<?php endif; ?>
