<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'Qué se dice de auditoscopia', 'tituloSeccion' => 'Qué se dice de auditoscopia')) ?>

<article id="content_nosotros_quienes">
    <a name="inicio"></a>
    <h1>Se dice de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span></h1>
    <section>
        <?php echo image_tag("img/static/Noticias_auditoscopia_medios_comunicación.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'Noticias sobre auditoscopia en los medios de comunicación.', 'title' => 'Noticias sobre auditoscopia en los medios de comunicación')) ?>        
        <p class="img_220">
            Esto es lo que se dice de nuestro proyecto en las Redes Sociales, prensa, televisión, radio y demás foros……….
        </p>
    </section>
    <div class="clear"></div>
    <div class="sustituto_epigrafe"></div>
    <section class="border-box-n">        
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    En estos momentos, nuestro proyecto está <strong>comenzando su andadura</strong> y aún no tiene la repercusión social que se merece. 
                </p>
                <p>
                    Si te identificas con nuestra filosofía y crees que merecemos ser noticia, por favor, <span class="subtitulo_haztecolaborador">¡Habla de nosotros!</span>
                </p>
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
        link_to("Quiénes somos", "nosotros/quienes", array('title' => 'Quiénes somos')) . ' - ' .
        link_to("Cómo funcionamos", "nosotros/como", array('title' => 'Cómo funcionamos')) . ' - ' .
        link_to("Colabora", "nosotros/colabora", array('title' => 'Colabora')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>