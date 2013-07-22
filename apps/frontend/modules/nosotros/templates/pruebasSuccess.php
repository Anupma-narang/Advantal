<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Pruebas','tituloSeccion'=>'Pruebas')) ?>

<article id="content_nosotros_comofuncionamos">
    <a name="inicio"></a>
    <h1>Cómo funcionamos</h1>
    <h2>Concursos de ideas para mejorar empresas, entidades públicas y productos</h2>

    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul>
                    <li>  
                        <?php echo link_to("Deseo ser informado", "nosotros_lightboxes/serinformado", array('class' => 'lightbox-i-contenido', 'title' => 'Deseo ser informado')); ?>.
                    </li>
                    <li>  
                        <?php echo link_to("Por qué crear un cuenta", "nosotros_lightboxes/porquecrearcuenta", array('class' => 'lightbox-i-contenido', 'title' => 'Deseo ser informado')); ?>.
                    </li>
                    <li>  
                        <?php echo link_to("Consejos cuenta", "nosotros_lightboxes/consejoscrearcuenta", array('class' => 'lightbox-i-contenido', 'title' => 'Deseo ser informado')); ?>.
                    </li>
                    <li>  
                        <?php echo link_to("Consejos contraseña", "nosotros_lightboxes/consejoscontrasena", array('class' => 'lightbox-i-contenido', 'title' => 'Deseo ser informado')); ?>.
                    </li>
                    <li>  
                        <?php echo link_to("Fases concurso", "nosotros_lightboxes/fasesconcurso", array('class' => 'lightbox-i-contenido', 'title' => 'Deseo ser informado')); ?>.
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
$pie = '<div id="menu_footer_texto">'. 
       link_to("Inicio","home/index", array('title'=>'Inicio')).' - '.
       link_to("¿Cómo funciona un concurso?","preguntasfrecuentes/concursos#B", array('title'=>'¿Cómo funciona un concurso?')).' - '.
       link_to("¿Cómo funciona el Directorio?","preguntasfrecuentes/auditarListas#K", array('title'=>'¿Cómo funciona el Directorio de buenos profesionales?')).' - '.
       link_to("Contrátanos","nosotros/empresa", array('title'=>'Contrátanos')).'
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">'.image_tag("img/img_flecha_menu_footer.png", array('title'=>'Ir arriba')).'</a>
   </div>';
slot('nosotros_footer', $pie);
?>