<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'Trabaja con nosotros', 'tituloSeccion' => 'Trabaja con nosotros')) ?>

<article id="content_nosotros_trabaja">
    <a name="inicio"></a>
    <h1>Trabaja con nosotros</h1>

    <section>
        <?php echo image_tag("img/static/Trabajar_comunidad_experiencia_cliente.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'Trabajar en la comunidad de experiencia de cliente.', 'title' => 'Trabajar en la comunidad de experiencia de cliente')) ?>     
        <p class="img_220">
            Esta es nuestra <strong>filosofía de trabajo:</strong>
            <br><br>
            <span class="bombilla">Creemos en el <strong>teletrabajo.</strong></span>
            <br>
            <span class="bombilla">Creemos en la <strong>conciliación de la vida laboral y personal.</strong></span>
            <br>
            <span class="bombilla">Creemos en la <strong>autogestión del tiempo</strong> y la carga de trabajo.</span>
        </p>
    </section>
    <div class="clear"></div>

    <h2>También creemos en:</h2>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li> 
                        La <strong>responsabilidad</strong> individual.
                    </li>
                    <li> 
                        El <strong>derecho a opinar</strong> y contribuir.
                    </li>
                    <li> 
                        Las <strong>habilidades y recursos reales</strong> de las personas.
                    </li>
                    <li> 
                        La empresa como un <strong>grupo de amigos con un objetivo</strong> común.
                    </li>
                    <li> 
                        La <strong>mejora continua</strong> como profesionales.
                    </li>
                    <li> 
                        El <strong>trabajo como parte de nuestra realización</strong> personal.
                    </li>
                </ul>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>

    <h2>Si te identificas con nuestra filosofía de trabajo…</h2>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    …Nos gustaría <strong>darte la bienvenida a la gran familia de</strong> <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>, donde te ofrecemos:
                </p>
                <ul>
                    <li> 
                        <strong>Formar parte de una idea innovadora</strong> y con visión de futuro.
                    </li>
                    <li>
                        <strong>Variedad de proyectos</strong> desde tu casa.
                    </li>
                    <li> 
                        Retos y oportunidades de <strong>aprendizaje continuos.</strong>
                    </li>
                    <li> 
                        <strong>Remuneración por proyecto</strong> y según complejidad.
                    </li>
                    <li> 
                        <strong>Autogestión de tu trabajo</strong> y tu tiempo.
                    </li>
                    <li> 
                        <strong>Posibilidad de ser socio</strong> y participar en la gestión de nuestra comunidad.
                    </li>
                </ul>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>

    <h2>Si eres un consultor independiente</h2>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    Si eres un <strong>consultor independiente a tiempo parcial o completo</strong>, en cualquier disciplina que creas que pueda resultar de nuestro interés, no lo dudes y envíanos tu CV a <a href="mailto:rrhh@auditoscopia.com" title="rrhh@auditoscopia.com">rrhh@auditoscopia.com</a>.
                </p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>
    <section class="hazte_colaborador">
        <p>
            Tú formas parte de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>:
            <span class="subtitulo_haztecolaborador">¡Hazte colaborador!</span>
        </p>        
    </section>
</article>

<?php
$pie = '<div id="menu_footer_texto">' .
        link_to("Inicio", "home/index", array('title' => 'Inicio')) . ' - ' .
        link_to("Quiénes somos", "nosotros/quienes", array('title' => 'Quiénes somos')) . ' - ' .
        link_to("Cómo funcionamos", "nosotros/como", array('title' => 'Cómo funcionamos')) . ' - ' .
        link_to("Nuestros servicios", "nosotros/nuestros", array('title' => 'Nuestros servicios')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>