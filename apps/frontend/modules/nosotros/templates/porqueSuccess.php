<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'Por qué existimos', 'tituloSeccion' => 'Por qué existimos')) ?>

<article>
    <a name="inicio"></a>
    <h1>Por qué existimos</h1> 
    <section>
        <?php echo image_tag("img/static/Inteligencia_colectiva_consumidores_excelencia_empresas_entidades.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'Crowdsourcing de consumidores para la mejora continua de empresas', 'title' => 'Inteligencia colectiva de los consumidores para la excelencia de empresas y entidades públicas')) ?>
        <p class="img_220">
            ¿Cuántas veces en la última semana has tenido una <?php echo link_to('experiencia de cliente insatisfactoria', 'preguntasfrecuentes/contribuir#B', array('title' => '¿Qué es una experiencia de cliente insatisfactoria?')); ?>?
            <br />
            <br />
            ¿Te gustaría poder decidir cómo quieres que sean los productos que consumes, los servicios que recibes o el entorno en el que vives?
        </p>
        <div class="clear"></div>
    </section>
    <h2>Contribución de los consumidores en la mejora de su experiencia de cliente</h2>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    Nuestro proyecto se basa en un concepto innovador, con vocación de servicio público y participación social, que propone la <strong>responsabilidad y contribución directa de los consumidores</strong> en la definición y mejora continua de los productos y servicios que recibimos por parte de las empresas, entidades públicas y profesionales.
                </p>
                <p>
                    Nuestro objetivo es conseguir que los productos y servicios que consumimos alcancen la <strong>Excelencia</strong> y se ajusten a nuestras necesidades y expectativas para que al disfrutarlos nos produzcan una <?php echo link_to('experiencia de cliente plenamente satisfactoria', 'preguntasfrecuentes/contribuir#C', array('title' => '¿Qué es una experiencia de cliente satisfactoria?')); ?>, única e irrepetible.
                </p>
                <p>
                    Hemos creado así un <strong>mecanismo de auditoría y asesoramiento</strong> continuo para ayudar a las empresas, entidades públicas y profesionales a conocernos mejor como clientes, adaptarse a nuestras preferencias y necesidades reales y apostar firmemente por la Excelencia.
                </p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>   
    <h2>¿Cuáles son nuestros objetivos?</h2>  
    <section class="postit">
        <div class="postit1">
            <div class="header">
                <p>
                    Mejorar productos y servicios
                </p>
            </div>
            <div class="body bold">
                <p>
                    Contribuir a la mejora de empresas, entidades públicas, productos y servicios.
                </p>
            </div>
            <div class="globo" style="background-image: url('/images/bocadillos/porque/mejorarprodyserv.png'); padding-top: 118px;padding-bottom: 12px;">
                <p>
                    Fomentar la producción de <strong>experiencias de cliente plenamente satisfactorias</strong> para los consumidores.
                </p>
            </div>
        </div>
        <div class="postit2">
            <div class="header">
                <p>
                    Cultura de Excelencia
                </p>
            </div>
            <div class="body bold">
                <p>
                    Promover la consolidación de una cultura de la excelencia.
                </p>
            </div>
            <div class="globo" style="background-image: url('/images/bocadillos/porque/culturadeexcelencia.png'); padding-top: 98px;">
                <p>
                    Innovación y <strong>mejora continua.</strong>                    
                </p>
            </div>
        </div>
        <div class="postit3">
            <div class="header" style="margin-left: -25px;">
                <p>
                    Diálogo con los consumidores
                </p>
            </div>
            <div class="body bold">
                <p>
                    Establecer una interacción y diálogo fluido entre empresas, entidades públicas, profesionales y consumidores.
                </p>
            </div>
            <div class="globo" style="background-image: url('/images/bocadillos/porque/dialogoconconsumidores.png'); padding-top: 105px;padding-bottom: 15px;">
                <p>
                    Crear <strong>relaciones sólidas de confianza mutua</strong> y reajuste permanente de expectativas.
                </p>
            </div>
        </div>
    </section>  
    <div class="clear"></div>
    <h2>¿De dónde surge esta idea? La inteligencia colectiva al poder </h2>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> nos definimos como un proyecto que desea ser un <strong>apéndice natural de las redes sociales</strong> y nos nutrimos del concepto comunitario y solidario de "<?php echo link_to("crowdsourding", "nosotros/glosarioterminos#Crowdsourcing", array('class' => 'glosario', 'title' => 'Crowdsourcing')) ?>": compartir la inteligencia colectiva y aunar esfuerzos para alcanzar una meta que beneficie a todos.
                </p>
                <p>
                    Además, creemos que el trabajo y el esfuerzo común por alcanzar esa meta debe ser recompensado con la justa <strong>distribución del beneficio económico</strong> que ese trabajo ha generado.
                </p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>
    <h2>¿Cuál es<strong> nuestra visión</strong>?</h2>
    <section class="fondo_parentesis">
        Liderar a la sociedad en la conquista de experiencias de cliente plenamente satisfactorias, únicas e irrepetibles
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
        link_to("Quiénes somos", "nosotros/quienes", array('title' => 'Quiénes somos')) . ' - ' .
        link_to("Nuestro decálogo", "nosotros/decalogo", array('title' => 'Nuestro decálogo')) . ' - ' .
        link_to("Cómo funcionamos", "nosotros/como", array('title' => 'Cómo funcionamos')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>