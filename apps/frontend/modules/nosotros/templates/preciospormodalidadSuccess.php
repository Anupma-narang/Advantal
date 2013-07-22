<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'Precios por modalidad de servicio', 'tituloSeccion' => 'Precios por modalidad de servicio')) ?>

<article id="content_nosotros_listablanca">
    <a name="inicio"></a>
    <h1>Precios por modalidad de servicio</h1>
    <div class="pxh20"></div>
    <p>
        <span class="bombilla"><strong class="pxsz16">Servicio <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> Experto:</strong> solicitar presupuesto específico.</span>
    </p>
    <p>
        <span class="bombilla"><strong class="pxsz16">Servicio Cliente Experto:</strong> solicitar presupuesto específico.</span>
    </p>
    <p class="encabezado_acordeon bombilla" label="Servicio Buen Profesional"><strong>Servicio Buen Profesional</strong></p> 
    <section class="border-box-n detalle_acordeon">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    Precios según el régimen profesional y tipo de suscripción:
                </p>
                <ol>
                    <li><strong>PROFESIONAL POR CUENTA AJENA</strong>
                        <ul>
                            <li><strong>Suscripción trimestral</strong>
                                <ul>
                                    <li><strong>34.99€/mes</strong> por profesional (IVA incl.).</li>
                                </ul>
                            </li>
                            <li><strong>Suscripción anual</strong>
                                <ul>
                                    <li><strong>29.99€/mes</strong> por profesional (IVA incl.).</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><strong>PROFESIONAL AUTÓNOMO O POR CUENTA PROPIA</strong>
                        <ul>
                            <li><strong>Suscripción trimestral </strong>
                                <ul>
                                    <li><strong>89.99€/mes</strong> por profesional (IVA incl.).</li>
                                </ul>
                            <li><strong>Suscripción anual</strong>
                                <ul>
                                    <li><strong>79.99€/mes</strong> por profesional (IVA incl.).</li>
                                </ul>
                            </li>
                        </ul></li>
                    </ul>
                    </li>
                </ol>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>
    <div class="clear"></div>
    <div class="pxh20"></div>
    <h2>Tabla resumen de precios</h2>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <?php echo link_to('Descarga la tabla resumen de Precios', '/pdfs/tabla_precios.pdf', array('class' => 'solo-responsive-grande', 'title' => 'Descarga la tabla resumen de Precios')) ?>
                <table class="pequena mediana">
                    <thead>
                        <tr>
                            <th colspan="2">SERVICIO</th>
                            <th colspan="2">PRECIO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="impar">
                            <td colspan="2"><strong><span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> EXPERTO</strong></td>
                            <td colspan="2">Solicitar presupuesto específico</td>
                        </tr>
                        <tr class="par">
                            <td colspan="2"><strong>CLIENTE EXPERTO</strong></td>
                            <td colspan="2">Solicitar presupuesto específico</td>
                        </tr>
                        <tr class="impar">
                            <td rowspan="4"><strong>BUEN PROFESIONAL</strong></td>
                            <td rowspan="2">PROFESIONAL CUENTA AJENA</td>
                            <td>Suscripción trimestral</td>
                            <td><strong>34.99€/mes</strong> por profesional (IVA  incl.).</td>
                        </tr>
                        <tr class="par">
                            <td>Suscripción anual</td>
                            <td><strong>29.99€/mes</strong> por profesional (IVA  incl.).</td>
                        </tr>
                        <tr class="impar">
                            <td rowspan="2">PROFESIONAL CUENTA PROPIA</td>
                            <td>Suscripción trimestral</td>
                            <td><strong>89.99€/mes</strong> por profesional (IVA  incl.).</td>
                        </tr>
                        <tr class="par">
                            <td>Suscripción anual</td>
                            <td><strong>79.99€/mes</strong> por profesional (IVA  incl.).</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>
</article>
<?php slot('js_footer', '
    
    <script type="text/javascript">
    
$(".detalle_acordeon").hide();
$(".encabezado_acordeon").bind("click", function() {
	    $(this).next().slideToggle(250);
});

    </script>
});

    </script>
    '); ?>
<?php
$pie = '<div id="menu_footer_texto">' .
        link_to("Inicio", "home/index", array('title' => 'Inicio')) . ' - ' .
        link_to("Nuestros servicios", "nosotros/nuestros", array('title' => 'Nuestros servicios')) . ' - ' .
        link_to("Cómo funcionamos", "nosotros/como", array('title' => 'Cómo funcionamos')) . ' - ' .
        link_to("Qué es el Directorio", "nosotros/directorio", array('title' => 'Qué es el Directorio de buenos profesionales')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>