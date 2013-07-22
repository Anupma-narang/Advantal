<div id="content_breadcroum">
    <?php echo link_to("Inicio", "home/index", array('title' => 'Inicio')) ?> >> <?php echo link_to("Nosotros", "nosotros/quienes", array('title' => 'Nosotros')) ?> >> <?php echo link_to("Preguntas + frecuentes", "preguntasfrecuentes/index", array('title' => 'Preguntas + frecuentes')) ?> >> <?php echo link_to($nombreSeccion, "preguntasfrecuentes/".sfContext::getInstance()->getActionName(), array('title' => $tituloSeccion)) ?>
</div>
