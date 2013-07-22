<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'Quiénes somos', 'tituloSeccion' => 'Quiénes somos')) ?>

<article id="content_nosotros_quienes">
    <a name="inicio"></a>
    <h1>Quiénes somos</h1>  
    <h2>Buscamos ideas para auditar y mejorar tu experiencia de cliente</h2>

    <section ><?php echo image_tag("img/static/Ideas_auditar_mejorar_experiencia_cliente.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'Ideas para auditar y mejorar tu experiencia de cliente.', 'title' => 'Ideas para auditar y mejorar tu experiencia de cliente')); ?>
        <p class="img_220">
            <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> somos una comunidad de consultores en <?php echo link_to("Experiencia de Cliente", "nosotros/glosarioterminos#Experiencia_de_cliente", array('class' => 'glosario', 'title' => 'Experiencia de Cliente')) ?>, de la que tú formas parte.
            <br />
            <br />
            Nosotros te ayudamos a <strong>auditar y mejorar tus productos, servicios y profesionales favoritos,</strong> para que se ajusten a tus necesidades y expectativas y te produzcan una <?php echo link_to("experiencia de cliente plenamente satisfactoria", "preguntasfrecuentes/contribuir#C", array('title' => '¿Qué es una experiencia de cliente satisfactoria?')) ?>, única e irrepetible.
        </p>
    </section>
    <div class="clear"></div>

    <h2>Si contribuyes con ideas, ganas recompensas </h2>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    Sólo lo podemos hacer con tu <?php echo link_to("contribución", "nosotros/glosarioterminos#Contribucion", array('class' => 'glosario', 'title' => 'Contribución')) ?>. Por eso, si te haces <?php echo link_to("colaborador", "nosotros/glosarioterminos#Colaborador", array('class' => 'glosario', 'title' => 'Colaborador')) ?> y contribuyes con tus ideas, <?php echo link_to("ganas recompensas", "nosotros/sistema", array('title' => 'Recompensas')) ?>.
                </p>
                <p>
                    Cada vez que auditas y mejoras un producto, servicio o profesional, <strong>ganas puntos canjeables por regalos.</strong>
                </p>
                <p>
                    Cuando tus ideas aportan valor, en opinión de los otros colaboradores de la Comunidad, <strong>ganas más puntos y más regalos.</strong>
                </p>
                <p>
                    Si, además, tus ideas generan una propuesta que aporta valor para la empresa, entidad pública o producto que deseas mejorar, <strong>compartimos contigo el beneficio económico</strong> de su venta.
                </p>
                <p>
                    Si quieres saber más sobre <strong>nuestra filosofía,</strong> visita nuestro <?php echo link_to("Decálogo", "nosotros/decalogo", array('title' => 'Nuestro decálogo')) ?>.
                </p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section> 

    <h2>¿Qué beneficios consigues al contribuir con <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>?</h2>    
    <section class="postit">
        <div class="postit1">
            <div class="header">
                <p>
                    Mejorar experiencia de cliente
                </p>
            </div>
            <div class="body bold">
                <p>
                    Mejoras tu experiencia de cliente y la de otros.
                </p>
            </div>
        </div>
        <div class="postit2">
            <div class="header">
                <p>
                    Dinero y regalos
                </p>
            </div>
            <div class="body bold">
                <p>
                    Mejoras tu producto, servicio o profesional favorito.
                </p>
                <p>
                    Ganas dinero y regalos.
                </p>
            </div>
        </div>
        <div class="postit3">
            <div class="header" style="margin-left: -20px;">
                <p>
                    Recomendaciones
                </p>
            </div>
            <div class="body bold">
                <p>
                    Recomiendas a tus amigos los mejores productos, servicios y profesionales.
                </p>
            </div>
        </div>
    </section>
    <div class="clear"></div>
    <h2> Esta es <strong>nuestra misión</strong>:</h2>  
    <section class="fondo_parentesis">
        Promover la participación de los consumidores en la definición y mejora de productos y servicios hasta la Excelencia, capaces de responder a sus necesidades y producirles una experiencia de cliente plenamente satisfactoria, a la vez que favorecer la redistribución justa del beneficio generado por su contribución. 
    </section>
    <div class="fin_fondo_parentesis"></div>
    <div class="clear"></div>
    <section class="hazte_colaborador">
        <p>
            Tú formas parte de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>:
            <span class="subtitulo_haztecolaborador">¡Hazte colaborador!</span>
        </p>        
    </section>
</article>
<?php
$pie = '<div id="menu_footer_texto">' .
        link_to("Inicio", "home/index", array('title' => 'Inicio')) . ' - ' .
        link_to("Por qué existimos", "nosotros/porque", array('title' => 'Por qué existimos')) . ' - ' .
        link_to("Cómo funcionamos", "nosotros/como", array('title' => 'Cómo funcionamos')) . ' - ' .
        link_to("Nuestros servicios", "nosotros/nuestros", array('title' => 'Nuestros servicios')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>