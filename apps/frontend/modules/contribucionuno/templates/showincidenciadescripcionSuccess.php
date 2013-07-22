<?php if(!$contribucion->getIncidencia()):?>
	<?php echo html_entity_decode($contribucion->getConcurso()->getIncidencia())?>
<?php else:?>
	<?php echo html_entity_decode($contribucion->getIncidencia())?>
<?php endif;?>