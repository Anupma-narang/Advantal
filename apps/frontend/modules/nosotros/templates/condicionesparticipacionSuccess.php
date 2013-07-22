<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'Condiciones de participación', 'tituloSeccion' => 'Condiciones de participación')) ?>

<article id="content_nosotros_condicionesparticipa"> 
    <a name="inicio"></a>
    <h1>Condiciones de participación</h1> 
    <h2>Normas sociales de la Comunidad</h2>

    <section>
        <?php echo image_tag("img/static/Condiciones_participación_comunidad_auditoscopia.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'Condiciones de participación en la comunidad de auditoscopia.', 'title' => 'Condiciones de participación en la comunidad de auditoscopia')) ?>
        <p class="img_220">
            Las normas de convivencia que rigen nuestro sitio web se basan en los siguientes principios:
        </p>
        <div class="clear"></div>
    </section>  
    <div class="sustituto_epigrafe"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p class="center">
                    <?php echo image_tag("si.png", array('alt' => 'SI')) ?>
                </p>                
                <ul>
                    <li>
                        Sé <strong>respetuoso</strong> con las contribuciones ajenas.
                    </li>
                    <li>
                        Sé <strong>amable</strong> e intenta llevarte bien con todo el mundo.
                    </li>
                    <li>
                        Sé <strong>activo</strong> y contribuye si tienes ideas interesantes que compartir.
                    </li>
                    <li>
                        Sé <strong>paciente</strong> con las contribuciones en respuesta a las tuyas. 
                    </li>
                    <li>
                        Sé <strong>positivo.</strong> Critica, pero de manera constructiva.
                    </li>
                    <li>
                        Sé <strong>original</strong> e innova. Haz propuestas atrevidas.
                    </li>
                    <li>
                        Sé <strong>ambicioso</strong> en tus Planes de acción pero, también, realista.
                    </li>
                    <li>
                        Sé <strong>comprensivo</strong> con las empresas, entidades o productos que estás auditando y ponte en su lugar.
                    </li>
                    <li>
                        Haz contribuciones <strong>interesantes que aporten valor.</strong>
                    </li>
                </ul>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>   
    <div class="pxh20"></div>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p class="center">
                    <?php echo image_tag("no.png", array('alt' => 'NO')) ?>
                </p>
                <ul>
                    <li>
                        <strong>No utilices lenguaje malsonante,</strong> ofensivo o que pueda herir la sensibilidad de otros colaboradores.
                    </li>
                    <li>
                        <strong>No contribuyas por contribuir.</strong> Hazlo sólo cuando tengas propuestas interesantes que aporten valor.
                    </li>
                    <li>
                        <strong>No despotriques</strong> sin más. Contribuye con soluciones.
                    </li>
                    <li>
                        <strong>No te compliques la vida</strong> con un lenguaje técnico o rebuscado. Sé natural y sencillo.
                    </li>
                    <li>
                        <strong>No ridiculices</strong> ni hagas de menos las contribuciones de otros colaboradores.  
                    </li>
                    <li>
                        <strong>No cuelgues archivos</strong> que no tengan que ver con el contenido de tu contribución.
                    </li>
                    <li>
                        <strong>No insultes ni ataques</strong> a otros colaboradores o a las empresas y entidades en concurso. 
                    </li>
                    <li>
                        <strong>No incites a la violencia</strong> o a realizar prácticas o acciones contrarias a la legislación vigente. 
                    </li>
                    <li>
                        <strong>No intimides, acoses ni amenaces</strong> a nadie, aunque tu experiencia de cliente haya sido muy insatisfactoria.
                    </li>
                </ul>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>   
    <div class="pxh20"></div>
    <div class="pxh20"></div>
    <section>   
        <p>
            <?php echo link_to('Antes de contribuir en la Comunidad', 'nosotros/antespublicarcontribucion', array('title' => 'Antes de contribuir en la Comunidad')) ?>
        </p>
    </section>
</article>

<?php
$pie = '<div id="menu_footer_texto">' .
        link_to("Inicio", "home/index", array('title' => 'Inicio')) . ' - ' .
        link_to("Aviso legal", "nosotros/avisolegal", array('title' => 'Aviso legal')) . ' - ' .
        link_to("¿Cómo informar sobre un comportamiento abusivo?", "preguntasfrecuentes/funcionamiento#D", array('title' => '¿Cómo informar sobre un comportamiento abusivo?')) . ' - ' .
        link_to("¿Cómo informar sobre un impostor?", "preguntasfrecuentes/funcionamiento#E", array('title' => '¿Cómo informar sobre un impostor?')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>