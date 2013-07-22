<?php use_helper('alternativeLink');?>
<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Política de anonimato','tituloSeccion'=>'Política de anonimato')) ?>

<article>
    <a name="inicio"></a>
    <h1>Política de anonimato</h1> 
    <section>
        <?php echo image_tag("img/static/Política_anonimato_comunidad_auditoscopia.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'Política de anonimato de la comunidad de auditoscopia.', 'title' => 'Política de anonimato de la comunidad de auditoscopia')) ?>
        <p class="img_220">
            Cualquier contribución, ponencia, auditoría o sugerencia que realices en <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> está <strong>amparada en el anonimato y protegida por nuestra</strong> <?php echo link_to('política de Privacidad y Protección de datos', 'nosotros/avisolegal#protecciondatos', array('title' => 'Aviso legal')); ?>.
        </p>
        <div class="clear"></div>
    </section>
    <h2>Mecanismos para asegurar tu anonimato</h2>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        <strong>Tu acceso a nuestra web se realiza siempre con tu alias,</strong> lo cual garantiza que ni tu nombre ni ningún otro dato identificativo aparezcan publicados en ella.
                    </li>
                    <li>
                        Todos los datos relevantes sobre tu perfil están guardados en la sección <?php echo authenticated_link_to($sf_user, "Mi cuenta", "vosotros/micuenta", "Mi cuenta", "nosotros_lightboxes/accesocuenta", array('title' => 'Mi cuenta'), array('title' => 'Mi cuenta', 'class'=>'lightbox-i')) ?>, a la que <strong>ningún otro colaborador tiene acceso,</strong> salvaguardando su confidencialidad.
                    </li>
                    <li>
                        Tus propuestas de mejora que forman parte de un <?php echo link_to('Plan de acción', 'nosotros/glosarioterminos#Plan_de_accion', array('class'=>'glosario','title'=>'Plan de acción'))?> <strong>no están identificadas con tu nombre.</strong>
                    </li>
                    <li>
                        <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> <strong>no publica ni traspasa tus datos personales a terceras partes,</strong> bajo ninguna circunstancia ni para ningún propósito.
                    </li>
                    <li>
                        Disponemos de las <strong>más altas medidas de seguridad en nuestro sitio web,</strong> que aseguran la protección de la integridad de tus datos contra incursiones no autorizadas.
                    </li>
                </ul>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>   
</article>
<?php
$pie = '<div id="menu_footer_texto">' .
        link_to("Inicio", "home/index", array('title' => 'Inicio')) . ' - ' .
        link_to("Puntos y Jerarquías", "nosotros/jerarquias", array('title' => 'Puntos y Jerarquías')) . ' - ' .
       link_to("¿Cómo informar sobre un comportamiento abusivo?","preguntasfrecuentes/funcionamiento#D", array('title'=>'¿Cómo informar sobre un comportamiento abusivo?')).' - '.
       link_to("¿Cómo informar sobre un impostor?","preguntasfrecuentes/funcionamiento#E", array('title'=>'¿Cómo informar sobre un impostor?')).'
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>