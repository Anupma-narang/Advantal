<div id="menu_side" class="nosotros">
    <nav class="nosotros">
        <?php echo link_to("Sobre auditoscopia", "preguntasfrecuentes/index", array("class" => sfContext::getInstance()->getActionName() == "index" ? "active" : "", 'title' => 'Sobre auditoscopia')) ?>
        <?php echo link_to("Contribuir con nosotros", "preguntasfrecuentes/contribuir", array("class" => sfContext::getInstance()->getActionName() == "contribuir" ? "active" : "", 'title' => 'Contribuir con nosotros')) ?>
        <?php echo link_to("Concursos", "preguntasfrecuentes/concursos", array("class" => sfContext::getInstance()->getActionName() == "concursos" ? "active" : "", 'title' => 'Concursos')) ?>
        <?php echo link_to("Alta y baja de servicio", "preguntasfrecuentes/altaBaja", array("class" => sfContext::getInstance()->getActionName() == "altaBaja" ? "active" : "", 'title' => 'Alta y baja de servicio')) ?>    
        <?php echo link_to("Participar en Referéndums", "preguntasfrecuentes/participarReferendums", array("class" => sfContext::getInstance()->getActionName() == "participarReferendums" ? "active" : "", 'title' => 'Participar en Referéndums')) ?>
        <?php echo link_to("Auditar y Listas", "preguntasfrecuentes/auditarListas", array("class" => sfContext::getInstance()->getActionName() == "auditarListas" ? "active" : "", 'title' => 'Auditar y Listas')) ?>
        <?php echo link_to("Recompensas", "preguntasfrecuentes/recompensas", array("class" => sfContext::getInstance()->getActionName() == "recompensas" ? "active" : "", 'title' => 'Recompensas')) ?>
        <?php echo link_to("Puntos y Jerarquías", "preguntasfrecuentes/puntosJerarquias", array("class" => sfContext::getInstance()->getActionName() == "puntosJerarquias" ? "active" : "", 'title' => 'Puntos y Jerarquías')) ?>      
        <?php echo link_to("Funcionamiento del sitio", "preguntasfrecuentes/funcionamiento", array("class" => sfContext::getInstance()->getActionName() == "funcionamiento" ? "active" : "", 'title' => 'Funcionamiento del sitio')) ?>
        <?php echo link_to("Contrátanos", "preguntasfrecuentes/contrata", array("class" => sfContext::getInstance()->getActionName() == "contrata" ? "active" : "", 'title' => 'Contrátanos')) ?>
    </nav>
    <?php echo image_tag("img/static/Dudas_comunidad_colaboradores_auditoscopia.jpg",array("title" => "Dudas sobre la comunidad de colaboradores de auditoscopia")) ?>     
</div>