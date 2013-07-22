<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Condiciones para ganar puntos','tituloSeccion'=>'Condiciones para ganar puntos')) ?>

<article id="content_nosotros_quienes">
    <a name="inicio"></a>
    <h1>Condiciones para ganar puntos</h1>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        Ganas puntos cada vez que contribuyes. El <strong>momento en el que los puntos pasan a tu cuenta</strong> depende del tipo de contribución que realices. Para conocer los detalles, visita <?php echo link_to('¿Cuándo pasan a mi cuenta los puntos que he ganado?', 'preguntasfrecuentes/puntosJerarquias#E', array('title'=>'¿Cuándo pasan a mi cuenta los puntos que he ganado?'))?>
                    </li>
                    <li>
                        Cuando contribuyas <strong>recomendando o desaprobando a un profesional,</strong> ten en cuenta que puedes valorar al mismo profesional hasta un máximo de 4 veces por <?php echo link_to('temporada', 'nosotros/glosarioterminos#Temporada', array('class'=>'glosario', 'title'=>'Temporada'))?> (recomendaciones o desaprobaciones), con un intervalo mínimo de 30 días entre cada valoración.
                    </li>
                    <li>
                        Además, puedes <strong>recomendar o desaprobar a todos los profesionales que desees</strong> y por todas las valoraciones ganas puntos.
                    </li>
                    <li>
                        Si contribuyes <strong>auditando en la lista blanca,</strong> puedes auditar todas la empresas, entidades públicas o productos que desees, y por todas ganas puntos también. Recuerda que puedes auditar <strong>hasta un máximo de 5 elementos por día.</strong>
                    </li>
                    <li>
                        Igualmente, puedes auditar la misma empresa, entidad o producto las veces que quieras. Puedes hacerlo con un <strong>intervalo de 30 días o más</strong> entre cada auditoría.
                    </li>
                    <li>
                        Si contribuyes <strong>recomendándonos a un amigo,</strong> ganas puntos únicamente si éste se da de alta como colaborador. Puedes recomendar a tantos amigos como desees y ganas puntos por un máximo de <strong>hasta 10</strong> recomendaciones (es decir "altas de amigos") por temporada.
                    </li>
                    <li>
                        Cuando contribuyas <strong>auditándonos a nosotros</strong>, ganas puntos por un máximo de <strong>hasta 5 Planes de acción</strong> por temporada, aunque nos puedes auditar tantas veces como quieras.
                    </li>
                    <li>
                        Si contribuyes <strong>compartiendo un caso de éxito</strong>, ganas puntos únicamente si publicamos tu contribución. Puedes compartir tantos casos de éxito como quieras y  ganas puntos por un máximo de <strong>hasta 5 casos</strong> por temporada. Para conocer las condiciones específicas visita <?php echo link_to("Cómo compartir tu caso de éxito", "nosotros/casoexito", array('title' => 'Cómo compartir tu caso de éxito')) ?><?php //TODO: link a Cómo compartir tu caso de éxito). ?>.
                    </li>
                    <li>
                        Aparte de los casos mencionados, <strong>puedes contribuir y ganar puntos sin límite</strong>. Sólo necesitas tener en cuenta nuestras <?php echo link_to('condiciones de participación', 'nosotros/condicionesparticipacion', array('title'=>'Condiciones de participación'))?>. 
                    </li>
                    <li style="list-style-image: none; list-style-type: none;">
                        <strong>¡Cuanto más contribuyas, más puntos ganas!</strong>
                    </li>
                </ul>
                <p>
                </p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section> 
<?php
$pie = '<div id="menu_footer_texto">' .
        link_to("Condiciones de participación ", "nosotros/condicionesparticipacion", array('title' => 'Condiciones de participación')) . ' - ' .
        link_to("Cómo ganar  puntos", "nosotros/comoganarpuntos2", array('title' => 'Cómo ganar  puntos')) . ' - ' .
        link_to("¿Cuándo pasan a mi cuenta los puntos que he ganado?", "preguntasfrecuentes/puntosJerarquias#E", array('title' => '¿Cuándo pasan a mi cuenta los puntos que he ganado?')) . ' - ' .
        link_to("Concursos", "concurso/index", array('title' => 'Concursos')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>
