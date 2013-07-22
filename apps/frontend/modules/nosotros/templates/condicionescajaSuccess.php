<?php use_helper('alternativeLink')?>
<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'Condiciones para hacer caja', 'tituloSeccion' => 'Condiciones para hacer caja')) ?>

<article id="content_nosotros_sistema">
    <a name="inicio"></a>
    <h1>Condiciones para hacer caja</h1>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        Hacer caja es el proceso mediante el cual <strong>haces efectivo el dinero</strong> que has ganado como <?php echo link_to("Participación en beneficio", "nosotros/participacionbeneficio", array('title' => 'Condiciones para la Participación en beneficio')) ?> y que has acumulado en tu <?php echo link_to("cuenta de colaborador", "nosotros/glosarioterminos#Cuenta_de_colaborador", array('class' => 'glosario', 'title' => 'Cuenta de colaborador')) ?>.
                    </li>
                    <li>
                        Para hacer caja, haz clic en <strong>hacer caja</strong>, que puedes encontrar en <?php echo authenticated_link_to($sf_user, "Mi cuenta", "vosotros/micuenta", "Mi cuenta", "nosotros_lightboxes/accesocuenta", array('title' => 'Mi cuenta'), array('title' => 'Mi cuenta', 'class'=>'lightbox-i')) ?>.
                    </li>
                    <li>
                        Si has ganado más de una Participación en beneficio, ¡enhorabuena! <strong>Participar en beneficio es acumulable</strong> y no tienen ningún límite.
                    </li>
                    <li>
                        Para hacer caja, necesitas tener un <strong>mínimo de 30€ acumulados</strong> en tu cuenta. Si la cantidad que acumulas es inferior a 30€, necesitas seguir contribuyendo hasta alcanzarla.
                    </li>
                    <li>
                        Cualquier cantidad acumulada en tu cuenta permanecerá <strong>guardada indefinidamente, hasta que alcances el mínimo</strong> de 30€ necesario para hacer caja.
                    </li>
                    <li>
                        En el momento en que acumulas 30€ o más, ya puedes hacer caja cuando lo desees, pero ten en cuenta que dispones de un <strong>plazo máximo de 6 meses,</strong> desde la última vez que participaste en beneficio, para hacerlo.
                    </li>
                    <li>
                        Una vez finalizado este plazo de 6 meses, si no haces caja, <strong>todo el dinero que no hayas hecho efectivo se convertirá en puntos canjeables</strong> (pero no acumulables), a razón de 100 puntos por cada euro acumulado.
                    </li>
                    <li>
                        Recuerda que, cualquier recompensa económica que recibas <strong>superior a 300€, está sujeta a la retención fiscal</strong> vigente. <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> procederá así a la deducción obligatoria antes del abono en tu cuenta.
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
        link_to("Cómo cobrar tu caja", "nosotros/cobrarcaja", array('title' => 'Cómo cobrar tu caja')) . ' - ' .
        link_to("Condiciones para la Participación en beneficio", "nosotros/participacionbeneficio", array('title' => 'Condiciones para la Participación en beneficio')) . ' - ' .
        link_to("Condiciones para canjear tus regalos", "nosotros/canjeregalos", array('title' => 'Condiciones para canjear tus regalos')) . ' - ' .
        link_to("Concursos", "concurso/index", array('title' => 'Concursos')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>       