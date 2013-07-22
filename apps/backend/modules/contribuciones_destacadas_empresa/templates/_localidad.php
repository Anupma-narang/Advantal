<?php if ($contribucion->getConcurso()->getCity()): ?>
    <?php echo $contribucion->getEmpresaCity(); ?>
<?php else: ?>
    <?php echo $contribucion->getConcurso()->getStates(); ?>
<?php endif; ?>
