<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Colabora','tituloSeccion'=>'Colabora')) ?>

<article id="content_nosotros_colabora">
    <a name="inicio"></a>
    <h1>Colabora</h1>  

    <section>
        <?php echo image_tag("img/static/Colaborar_comunidad_experiencia_cliente.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'Colaborar con la comunidad de experiencia de cliente', 'title' => 'Colaborar con la comunidad de experiencia de cliente')) ?>     
        <p class="img_220">
            <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> no podría existir sin tu contribución. 
            <br>
            <br>
            Por eso te ofrecemos varias maneras en las que <strong>puedes colaborar con nosotros:</strong>
        </p>
    </section>
    <div class="clear"></div>
    <div class="sustituto_epigrafe"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        Creando un <strong>nuevo</strong> <?php echo link_to("concurso", "preguntasfrecuentes/concursos#A", array('title' => '¿Qué es un concurso?')); ?>.
                    </li>
                    <li>
                        <strong>Haciendo una</strong> <?php echo link_to("contribución", "nosotros/glosarioterminos#Contribucion", array('class' => 'glosario', 'title' => 'Contribución')); ?> en un concurso ya existente.
                    </li>
                    <li>
                        <strong>Votando en el</strong> <?php echo link_to("Referéndum", "nosotros/glosarioterminos#Referendum", array('class' => 'glosario', 'title' => 'Referéndum')); ?> del concurso en el que contribuyes.
                    </li>
                    <li>
                         <?php echo link_to('Recomendando', 'preguntasfrecuentes/auditarListas#G' ,array('title'=>'¿Qué es recomendar a un profesional?')) ?> a un buen profesional.
                    </li>
                    <li>
                        <?php echo link_to('Desaprobando', 'preguntasfrecuentes/auditarListas#H' ,array('title'=>'¿Qué es desaprobar a un profesional?')) ?> a un profesional.
                    </li>
                    <li>
                        <strong>Auditando en</strong> la <?php echo link_to('lista blanca', 'nosotros/listablanca' ,array('title'=>'Lista blanca de la Excelencia')) ?>.
                    </li>
                    <li>
                        <strong>Auditándonos a nosotros</strong> y ayudándonos a mejorar.
                    </li>
                    <li>
                        <?php echo link_to('Recomendando nuestra web a un amigo.', 'nosotros/recomiendanos' ,array('title'=>'Recomiéndanos a un amigo')) ?>
                    </li>
                    <li>
                        <strong>Trabajando para nosotros.</strong>
                    </li>
                    <li>
                        <strong>Exigiendo tus derechos</strong> como consumidor.
                    </li>
                </ul>
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
$pie = '<div id="menu_footer_texto">'. 
       link_to("Inicio","home/index", array('title'=>'Inicio')).' - '.
       link_to("Trabaja con nosotros","nosotros/trabaja", array('title'=>'Trabaja con nosotros')).' - '.
       link_to("Audítanos","nosotros/audita", array('title'=>'Audítanos')).' - '.
       link_to("Recomiéndanos a un amigo","nosotros/recomiendanos", array('title'=>'Recomiéndanos a un amigo')).'
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">'.image_tag("img/img_flecha_menu_footer.png", array('title'=>'Ir arriba')).'</a>
   </div>';
slot('nosotros_footer', $pie);
?>