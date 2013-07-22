<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Nuestro decálogo','tituloSeccion'=>'Nuestro decálogo')) ?>

<article id="content_nosotros_decalogo">

    <a name="inicio"></a>
    <h1>Nuestro decálogo</h1> 
    <h2>Decálogo de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> para la Excelencia de productos y servicios</h2>

    <section><?php echo image_tag("img/static/" . sfContext::getInstance()->getActionName() . "_img0_lateral.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'Consejos para la excelencia de productos, servicios y profesionales.', 'title' => 'Consejos para la excelencia de productos, servicios y profesionales.')); ?>
        <p class="img_220">
            <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> somos una <strong>comunidad virtual de consultores</strong> en Experiencia de Cliente, con el objetivo de mejorar empresas, entidades públicas y profesionales, así como los productos y servicios que nos prestan.
        </p>
        <div class="clear"></div>
    </section>
    <div class="sustituto_epigrafe"></div>

    <section class="border-box-n">        
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        Creemos que los consumidores <strong>merecemos productos y servicios de la más alta calidad,</strong> para que cada uno de ellos se convierta en una <?php echo link_to('experiencia de cliente plenamente satisfactoria', 'preguntasfrecuentes/contribuir#C', array('title' => '¿Qué es una experiencia de cliente satisfactoria?')) ?>, única e irrepetible.
                    </li>
                    <li>
                        Defendemos que una experiencia de cliente única y memorable no debería ser patrimonio exclusivo de productos o servicios selectos, por lo que promovemos la <strong>democratización de la Excelencia.</strong>
                    </li>
                    <li>
                        Comprobamos que existen muchas empresas, entidades públicas y profesionales, así como sus productos y servicios, que nos producen una <?php echo link_to('experiencia de cliente insatisfactoria','preguntasfrecuentes/contribuir#B', array('title'=>'¿Qué es una experiencia de cliente insatisfactoria?'))?>, porque  <strong>no cumplen con la Excelencia</strong> y no se ajustan a las necesidades y expectativas de los consumidores. 
                    </li>
                    <li>
                        Proponemos la <strong>participación y responsabilidad de los consumidores</strong> en la mejora continua de los productos y servicios de los que somos usuarios. De esta manera contribuimos a crear productos y servicios que se adaptan a nuestras necesidades.
                    </li>
                    <li>
                        Ofrecemos a las empresas, entidades públicas y profesionales la oportunidad de establecer una <strong>interacción directa con sus clientes</strong>, y utilizar nuestros conocimientos y experiencia como usuarios en la mejora continua de sus productos y servicios.
                    </li>
                    <li>
                        Creemos en el trabajo y el esfuerzo colectivo, y por eso fomentamos la <strong>distribución justa del beneficio económico</strong> generado por la mejora de esos productos y servicios, entre todos los consumidores que se han implicado y comprometido con ello.
                    </li>
                    <li>
                        Auditamos que las mejoras realizadas generan <strong>productos y servicios que cumplen con la Excelencia</strong> de manera efectiva, y están diseñados para ajustarse a nuestras necesidades y expectativas cambiantes.
                    </li>
                    <li>
                        <strong>Detectamos las posibles desviaciones</strong> de la excelencia alcanzada, y emprendemos acciones concretas para corregirlas a tiempo.
                    </li>
                    <li>
                        <strong>Ayudamos a las empresas</strong>, entidades públicas y profesionales a ajustarse de manera dinámica a nuestras necesidades y expectativas según evolucionan, incrementando nuestra satisfacción como clientes, identificando nuevas necesidades de negocio y aumentando su rentabilidad.
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
       link_to("Cómo funcionamos","nosotros/como", array('title'=>'Cómo funcionamos')).' - '.
       link_to("Contrátanos","nosotros/empresa", array('title'=>'Contrátanos')).'
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">'.image_tag("img/img_flecha_menu_footer.png", array('title'=>'Ir arriba')).'</a>
   </div>';
slot('nosotros_footer', $pie);
?>