<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Decálogo de la lista blanca','tituloSeccion'=>'Decálogo de la lista blanca')) ?>

<article id="content_nosotros_decalogo">

    <a name="inicio"></a>
    <h1>Decálogo de la lista blanca</h1> 

    <section><?php echo image_tag("img/static/Excelencia_es_cuidar_consumidores.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'Excelencia es cuidar a tus clientes.', 'title' => 'Excelencia es cuidar a los consumidores')); ?>
        <p class="img_220">
            La lista blanca no es la meta, sino <strong>una oportunidad para seguir mejorando y consolidar tu negocio.</strong>
        </p>
        <div class="clear"></div>
    </section>
    <div class="sustituto_epigrafe"></div>
    <section class="border-box-n">        
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        La lista blanca no depende del capricho de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>, sino de la <strong>voluntad de tus clientes</strong>, que opinan que tu negocio debe estar aquí porque se ajusta a sus necesidades y expectativas.
                    </li>
                    <li>
                        La lista blanca no es un certificado para pegar en la pared. Es una declaración pública de tus clientes, de que tu negocio les produce una <strong>experiencia de cliente única y memorable.</strong>
                    </li>
                    <li>
                        La lista blanca no es un regalo generoso. Es un <strong>reconocimiento que te has ganado</strong> con tu esfuerzo, porque tus clientes opinan que "lo estás haciendo bien".
                    </li>
                    <li>
                        La lista blanca no quiere decir que ya no tengas cosas que mejorar. Significa que, a día de hoy, tus clientes obtienen lo que esperan. <strong>¡No te duermas en los laureles!</strong>
                    </li>
                    <li>
                        La lista blanca no indica que tienes que seguir ofreciendo lo mismo. Es un impulso para <strong>innovar y seguir destacando</strong> por encima de los demás.
                    </li>
                    <li>
                        La lista blanca no va a trabajar por ti. Sé realista contigo mismo y <strong>reflexiona sobre tu negocio.</strong> Seguirás ganando más clientes.
                    </li>
                    <li>
                        La lista blanca no es para siempre. <strong>Tu negocio también puede salir de ella si no mimas a tus clientes.</strong> ¡Cuídalos!
                    </li>
                    <li>
                        La lista blanca <strong>depende exclusivamente de ti.</strong> Tú decides si entras o si sales.
                    </li>
                    <li>
                        La lista blanca es un <strong>guiño a tus clientes</strong>.
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
       link_to("Quiénes somos","nosotros/quienes", array('title'=>'Quiénes somos')).' - '.
       link_to("Nuestros servicios","nosotros/nuestros", array('title'=>'Nuestros servicios')).' - '.
       link_to("Decálogo de la lista negra","nosotros/decalogolistanegra", array('title'=>'Decálogo de la lista negra')).'
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">'.image_tag("img/img_flecha_menu_footer.png", array('title'=>'Ir arriba')).'</a>
   </div>';
slot('nosotros_footer', $pie);
?>