<?php use_helper('alternativeLink');?>
<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'Condiciones para canjear tus regalos', 'tituloSeccion' => 'Condiciones para canjear tus regalos')) ?>

<article id="content_nosotros_sistema">
    <a name="inicio"></a>
    <h1>Condiciones para canjear tus regalos</h1>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        Para canjear un regalo necesitas acumular puntos en tu <?php echo link_to("cuenta de puntos canjeables", "nosotros/glosarioterminos#Cuenta_de_puntos_canjeables", array('class' => 'glosario', 'title' => 'Puntos canjeables')) ?>. 
                    </li>
                    <li>
                        Los regalos que recibes no se pueden cambiar por su equivalente económico, en ninguna circunstancia.
                    </li>
                    <li>
                        Los artículos canjeables varían a lo largo del año y tienen <strong>diferente valor,</strong> según la cantidad de puntos requeridos. Todos los regalos disponibles se muestran en el <?php echo link_to("Escaparate de regalos", "preguntasfrecuentes/funcionamiento#A", array('title' => '¿Qué es el escaparate de regalos y cómo funciona?')) ?>.
                    </li>
                    <li>
                        Puedes <strong>canjear tantos regalos como quieras</strong>, si  están disponibles en ese momento y tienes los puntos necesarios.
                    </li>
                    <li>
                        Todos los regalos están <strong>sujetos a disponibilidad</strong> y fin de existencias. Si el artículo que deseas se ha agotado, te daremos la opción de elegir otro de valor equivalente o de que guardes tus puntos para otra ocasión.
                    </li>
                    <li>
                        El <strong>envío a domicilio</strong> corre a cargo de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>, según los criterios establecidos en las <?php echo link_to("Condiciones para el envío de regalos", "nosotros/comofuncionaenvioregalos", array('title' => 'Condiciones para el envío de regalos')) ?>.
                    </li>
                    <li>
                        Para canjear un regalo, haz clic en <strong>canjea regalo</strong>, que puedes encontrar en <?php echo authenticated_link_to($sf_user, "Mi cuenta", "vostros/micuenta", "Mi cuenta", "nosotros_lightboxes/accesocuenta", array('title' => 'Mi cuenta'), array('title' => 'Mi cuenta', 'class'=>'lightbox-i')) ?> o en el <?php echo link_to("Escaparate de regalos", "preguntasfrecuentes/funcionamiento#A", array('title' => 'Escaparate de regalos')) ?>.
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
        link_to("Condiciones para la Participación en beneficio", "nosotros/participacionbeneficio", array('title' => 'Condiciones para la Participación en beneficio')) . ' - ' .
        link_to("Condiciones para hacer caja", "nosotros/condicionescaja", array('title' => 'Condiciones para hacer caja')) . ' - ' .
        link_to("Cómo cobrar tu caja", "nosotros/cobrarcaja", array('title' => 'Cómo cobrar tu caja')) . ' - ' .
        link_to("Concursos", "concurso/index", array('title' => 'Concursos')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>     