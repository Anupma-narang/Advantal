<?php use_helper('alternativeLink');?>
<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'Cómo cobrar tu caja', 'tituloSeccion' => 'Cómo cobrar tu caja')) ?>

<article id="content_nosotros_sistema">
    <a name="inicio"></a>
    <h1>Cómo cobrar tu caja</h1>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> ponemos a tu disposición los siguientes <strong>métodos de cobro</strong> para hacer efectivo el dinero acumulado en tu caja:<br/>
                </p>
                <ul>
                    <li>
                        <strong>Abono por transferencia</strong>
                    </li>
                    <li>
                        <strong>Paypal</strong>
                    </li>
                </ul>
                <p>
                    Puedes <strong>configurar el método de cobro</strong> que prefieras en <?php echo authenticated_link_to($sf_user, "Mi cuenta", "vostros/micuenta", "Mi cuenta", "nosotros_lightboxes/accesocuenta", array('title' => 'Mi cuenta'), array('title' => 'Mi cuenta', 'class'=>'lightbox-i')) ?>-Datos de facturación.
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
        link_to("Condiciones para hacer caja", "nosotros/condicionescaja", array('title' => 'Condiciones para hacer caja')) . ' - ' .
        link_to("Condiciones para participar en beneficio", "nosotros/participacionbeneficio", array('title' => 'Condiciones para la Participación en beneficio')) . ' - ' .
        link_to("Condiciones para canjear tus regalos", "nosotros/canjeregalos", array('title' => 'Condiciones para canjear tus regalos')) . ' - ' .
        link_to("Concursos", "concurso/index", array('title' => 'Concursos')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>     