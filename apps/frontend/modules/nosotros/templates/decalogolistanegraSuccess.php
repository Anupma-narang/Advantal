<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Decálogo de la lista negra','tituloSeccion'=>'Decálogo de la lista negra')) ?>

<article id="content_nosotros_decalogo">

    <a name="inicio"></a>
    <h1>Decálogo de la lista negra</h1> 

    <section><?php echo image_tag("img/static/Lista_negra_oportunidad_mejorar_negocio.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'La lista negra es una oportunidad para mejorar tu negocio.', 'title' => 'La lista negra es una oportunidad para mejorar tu negocio')); ?>
        <p class="img_220">
            La lista negra no es una medida de castigo, sino <strong>una oportunidad de mejorar y reforzar tu negocio.</strong>
        </p>
        <div class="clear"></div>
    </section>
    <div class="sustituto_epigrafe"></div>
    <section class="border-box-n">        
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        La lista negra no depende del capricho de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>, sino de la <strong>voluntad de tus clientes</strong>, que opinan que tu negocio debe estar aquí porque no se ajusta a sus necesidades y expectativas.
                    </li>
                    <li>
                        La lista negra no es una condena pública. Es un <strong>toque de atención por parte de tus clientes</strong>, porque tu negocio no les produce una experiencia de cliente única y memorable, y puedes hacerlo mejor.
                    </li>
                    <li>
                        La lista negra no es una carga. Es un <strong>regalo que te ofrecen tus clientes</strong> para que los conozcas mejor. ¡Aprovéchalo!
                    </li>
                    <li>
                        La lista negra no quiere decir que hagáis mal las cosas. Significa que, a día de hoy, tus clientes no están obteniendo lo que esperan. <strong>¡Ponte las pilas!</strong>
                    </li>
                    <li>
                        La lista negra no indica que tienes que dejar de ofrecer lo mismo. Es un impulso para <strong>innovar y probar cosas nuevas.</strong>
                    </li>
                    <li>
                        La lista negra no te va a hundir en la miseria, te va a mostrar otras maneras de trabajar. Sé realista contigo mismo y <strong>reflexiona sobre tu negocio.</strong> Ganarás más clientes.
                    </li>
                    <li>
                        La lista negra no es para siempre. <strong>Tu negocio también puede salir de ella si mimas a tus clientes.</strong> ¡Cuídalos!
                    </li>
                    <li>
                        La lista negra <strong>depende exclusivamente de ti.</strong> Tú decides si sales o si entras.
                    </li>
                    <li>
                        La lista negra es <strong>un guiño de tus clientes.</strong>
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
       link_to("¿Cómo salir de la lista negra?","preguntasfrecuentes/auditarListas#F", array('title'=>'Cómo puede una empresa o entidad salir de la lista negra?')).' - '.
       link_to("Decálogo de la lista blanca","nosotros/decalogolistablanca", array('title'=>'Decálogo de la lista blanca')).' - '.
       link_to("Nuestros servicios","nosotros/nuestros", array('title'=>'Nuestros servicios')).'
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">'.image_tag("img/img_flecha_menu_footer.png", array('title'=>'Ir arriba')).'</a>
   </div>';
slot('nosotros_footer', $pie);
?>
