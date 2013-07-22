<div id="menu_side" class="nosotros">
    <div id="concurso_side">
        <nav class="nosotros">
            <?php echo link_to("Quiénes somos", "nosotros/quienes", array("class" => sfContext::getInstance()->getActionName() == "quienes" ? "active" : "", 'title' => 'Quiénes somos')) ?>
            <?php echo link_to("Por qué existimos", "nosotros/porque", array("class" => sfContext::getInstance()->getActionName() == "porque" ? "active" : "", 'title' => 'Por qué existimos')) ?>
            <?php echo link_to("Cómo funcionamos", "nosotros/como", array("class" => sfContext::getInstance()->getActionName() == "como" ? "active" : "", 'title' => 'Cómo funcionamos')) ?>
            <?php echo link_to("Recompensas", "nosotros/sistema", array("class" => sfContext::getInstance()->getActionName() == "sistema" ? "active" : "", 'title' => 'Recompensas')) ?>
            <?php echo link_to("Puntos y Jerarquías", "nosotros/jerarquias", array("class" => sfContext::getInstance()->getActionName() == "jerarquias" ? "active" : "", 'title' => 'Puntos y Jerarquías')) ?>      
            <?php echo link_to("Nuestros servicios", "nosotros/nuestros", array("class" => sfContext::getInstance()->getActionName() == "nuestros" ? "active" : "", 'title' => 'Nuestros servicios')) ?>
            <?php echo link_to("Contrátanos", "nosotros/empresa", array("class" => sfContext::getInstance()->getActionName() == "empresa" ? "active" : "", 'title' => 'Contrátanos')) ?>
            <?php echo link_to("Colabora", "nosotros/colabora", array("class" => sfContext::getInstance()->getActionName() == "colabora" ? "active" : "", 'title' => 'Colabora')) ?>
            <?php echo link_to("Trabaja con nosotros", "nosotros/trabaja", array("class" => sfContext::getInstance()->getActionName() == "trabaja" ? "active" : "", 'title' => 'Trabaja con nosotros')) ?>
            <?php echo link_to("Audítanos", "nosotros/audita", array("class" => sfContext::getInstance()->getActionName() == "audita" ? "active" : "", 'title' => 'Audita a auditoscopia')) ?>
            <?php echo link_to("Se dice de auditoscopia...", "nosotros/quese", array("class" => sfContext::getInstance()->getActionName() == "quese" ? "active" : "", 'title' => 'Se dice de auditoscopia...')) ?>
    <!--        <div><?php //echo link_to("Nuestra mesa redonda","nosotros/quese", array("class"=>sfContext::getInstance()->getActionName()=="quese"?"active":""))                           ?></div>-->
            <?php //echo image_tag("img/static/porque_existimos.jpg", array("class"=>sfContext::getInstance()->getActionName()=="quienes"?"active":""))?>
        </nav>
    </div>
    <div id="img_left">
        <?php if (sfContext::getInstance()->getActionName() == "quienes"): ?>
            <?php $img_title = "Contribuir con ideas para la mejora de tu experiencia de cliente"; ?>
            <?php $img_name = "Contribuir_ideas_mejora_experiencia_cliente"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "como"): ?>
            <?php $img_title = "Listas de empresas, entidades públicas, productos y profesionales recomendados"; ?>
            <?php $img_name = "Empresas_entidades_productos_profesionales recomendados"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "porque"): ?>
            <?php $img_title = "Crowdsourcing para la mejora continua de productos y servicios"; ?>
            <?php $img_name = "Crowdsourcing_consumidores_mejora_continua_productos_servicios"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "sistema"): ?>
            <?php $img_title = "Regalos y participación en beneficio por contribuciones en concursos"; ?>
            <?php $img_name = "Regalos_participación_beneficio_contribuciones_concursos"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "jerarquias"): ?>
            <?php $img_title = "Jerarquía de la comunidad de colaboradores por puntos"; ?>
            <?php $img_name = "Jerarquía_comunidad_colaboradores_puntos"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "nuestros"): ?>
            <?php $img_title = "Auditorías de gestión de experiencia de cliente"; ?>
            <?php $img_name = "Auditorías_gestión_experiencia_cliente"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "colabora"): ?>
            <?php $img_title = "Contribuir en la comunidad de auditoscopia"; ?>
            <?php $img_name = "Contribuir_comunidad_auditoscopia"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "trabaja"): ?>
            <?php $img_title = "Formar parte del panel de expertos la comunidad de auditoscopia"; ?>
            <?php $img_name = "Panel_expertos_comunidad_experiencia_cliente"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "empresa"): ?>
            <?php $img_title = "Crear una experiencia de cliente satisfactoria y memorable"; ?>
            <?php $img_name = "Crear_experiencia_cliente_satisfactoria_memorable"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "listablanca"): ?>
            <?php $img_title = "Empresas, entidades públicas y productos recomendados por su excelencia"; ?>
            <?php $img_name = "Empresas_entidades_públicas_productos_recomendados_excelencia"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "listanegra"): ?>
            <?php $img_title = "Empresas, entidades públicas y productos no recomendados por los consumidores"; ?>
            <?php $img_name = "Empresas_entidades_públicas_productos_no_recomendados_consumidores"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "directorio"): ?>
            <?php $img_title = "Recomendar a un profesional por sus buenas prácticas"; ?>
            <?php $img_name = "Recomendar_profesional_buenas_prácticas"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "decalogolistablanca"): ?>
            <?php $img_title = "Consejos para entrar en la lista blanca de productos y servicios recomendados"; ?>
            <?php $img_name = "Consejos_entrar_lista_blanca_productos_servicios_recomendados"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "decalogolistanegra"): ?>
            <?php $img_title = "Consejos para salir de la lista negra de productos y servicios no recomendados"; ?>
            <?php $img_name = "Consejos_salir_lista_negra_productos_servicios_no_recomendados"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "avisolegal"): ?>
            <?php $img_title = "Condiciones legales para la participación en auditoscopia"; ?>
            <?php $img_name = "Condiciones_legales_participación_auditoscopia"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "terminosycondiciones"): ?>
            <?php $img_title = "Condiciones de servicio de auditoscopia"; ?>
            <?php $img_name = "Condiciones_servicio_auditoscopia"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "condicionesparticipacion"): ?>
            <?php $img_title = "Condiciones de  participación para colaboradores de auditoscopia"; ?>
            <?php $img_name = "Condiciones_participación_colaboradores_auditoscopia"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "politicadeanonimato"): ?>
            <?php $img_title = "Política de anonimato para colaboradores de auditoscopia"; ?>
            <?php $img_name = "Política_anonimato_colaboradores_auditoscopia"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "glosarioterminos"): ?>
            <?php $img_title = "Glosario de términos para colaboradores de auditoscopia"; ?>
            <?php $img_name = "Glosario_términos_colaboradores_auditoscopia"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "quese"): ?>
            <?php $img_title = "La comunidad de experiencia de cliente en internet, prensa, radio, televisión y medios sociales"; ?>
            <?php $img_name = "Comunidad_experiencia_cliente_internet_prensa_radio_televisión_medios_sociales"; ?>
        <?php elseif (sfContext::getInstance()->getActionName() == "audita"): ?>
            <?php $img_title = "Ayuda a la comunidad de experiencia de cliente a adaptarse a tus necesidades y preferencias"; ?>
            <?php $img_name = "Ayuda_comunidad_experiencia_cliente_adaptarse_necesidades_preferencias"; ?>
        <?php endif; ?>

        <?php if (isset($img_name) && isset($img_title)): ?>
            <?php echo image_tag("img/static/" . $img_name . ".jpg", array("title" => $img_title)) ?>     
        <?php endif; ?>
    </div>
</div>