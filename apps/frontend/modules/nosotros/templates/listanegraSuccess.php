<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Qué es la lista negra','tituloSeccion'=>'Qué es la lista negra')) ?>

<article id="content_nosotros_listanegra">
    <a name="inicio"></a>
    <h1>Qué es la lista negra de la Excelencia</h1> 
    <h2>Guía de empresas, entidades y productos no recomendados</h2>

    <section><?php echo image_tag("img/static/Empresas_entidades_ productos_no_recomendados.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'Guía de empresas, entidades públicas y productos no recomendados.', 'title' => 'Empresas, entidades públicas y productos no recomendados')); ?>
        <p class="img_220">
            La lista negra de la Excelencia consiste en una <strong>guía de referencia</strong> de empresas, entidades públicas y productos de consumo que <strong>no son recomendados por sus clientes</strong>.
        </p>
        <div class="clear"></div>
    </section>
    <div class="sustituto_epigrafe"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                     Estas empresas, entidades públicas y productos no están recomendados porque no se ajustan a las necesidades y expectativas de sus usuarios, y les producen una <?php echo link_to('experiencia de cliente insatisfactoria', 'preguntasfrecuentes/contribuir#B', array('title' => '¿Qué es una experiencia de cliente insatisfactoria?')) ?>.
                </p>
                <p>
                    La lista negra está dispuesta en <strong>dos apartados: </strong>
                </p>
                <ul>
                    <li>
                        <strong>Empresas y entidades públicas</strong> de diferentes actividades, donde se audita la Excelencia en el conjunto de productos y servicios ofrecidos por las mismas.
                    </li>
                    <li>
                        <strong>Productos</strong> de consumo de diferentes categorías, donde se valoran las prestaciones y características del producto (funcionalidad, usabilidad, diseño, presentación, etc.).
                    </li>
                </ul>
                <p>
                    ¿Quieres saber <?php echo link_to('cómo se entra en la lista negra?', 'nosotros/comoformarnegra', array('title' => 'Cómo se entra en la lista negra')) ?>
                </p>
                <p>
                    También necesitas saber <?php echo link_to('cómo no se entra en la lista negra', 'nosotros/comonoformarnegra', array('title' => 'Cómo no se entra en la lista negra')) ?>
                </p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>
    <h2>¿Qué objetivos persigue la lista negra?</h2>
    
    
    <section class="postit">
        <div class="postit1">
            <div class="header">
                <p>
            Hacer público el desajuste
                </p>
            </div>
            <div class="body bold">
                <p>
                    Hacer público las empresas, entidades públicas y productos que no se ajustan a las necesidades y expectativas de sus usuarios y les producen una experiencia de cliente insatisfactoria.
                </p>
            </div>
            <div class="globo" style="background-image: url('/images/bocadillos/listanegra/hacer_publico_desajuste.png'); padding-top: 96px;">
                <p>
                    <strong>Servir de referencia</strong> a otros consumidores
                </p>
            </div>
        </div>
        <div class="postit2">
            <div class="header">
                <p>
            Concienciar sobre expectativas
                </p>
            </div>
            <div class="body bold">
                <p>
                    Concienciar a estas empresas, entidades y productos sobre la importancia de ajustarse a las necesidades y expectativas de sus clientes
                </p>
            </div>
            <div class="globo" style="background-image: url('/images/bocadillos/listanegra/concienciar_expectativas.png'); padding-top: 95px; padding-bottom: 15px;">
                <p>
                    <strong>Desarrollar la Excelencia</strong> como objetivo principal.
                </p>
            </div>
        </div>
        <div class="postit3">
            <div class="header" style="margin-left: -25px;">
                <p>
            Desarrollar la Excelencia
                </p>
            </div>
            <div class="body bold">
                <p>
                    Estimular la puesta en práctica de acciones concretas de mejora de los productos o servicios ofrecidos.
                </p>
            </div>
            <div class="globo" style="background-image: url('/images/bocadillos/listablanca/auditoria_continua.png'); padding-top: 133px;padding-bottom: 12px; width: 155px;">
                <p>
                    <strong>Beneficiar a los consumidores</strong> y reforzar el negocio.
                </p>
            </div>
        </div>
    </section> 
    <div class="clear"></div>
    <h2>Lista negra = desajuste con las necesidades de los usuarios</h2>
    <section class="border-box-n">
        
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    Formar parte de la lista negra no significa necesariamente que una empresa, entidad pública o producto sea deficiente o de mala calidad. 
                </p>
                <p>
                    Simplemente, no se ajusta a las necesidades y expectativas de sus usuarios y necesita mejorar, con el fin de producirles una experiencia de cliente satisfactoria, tal y como se establece en el <?php echo link_to('Decálogo de la lista negra', 'nosotros/decalogolistanegra', array('title'=>'Decálogo de la lista negra'))?>
                </p>
                <p>
                    Estar en la lista negra no es para siempre. Para saber cómo salir, visita <?php echo link_to('Cómo salir de la lista negra', 'preguntasfrecuentes/auditarListas#F', array('title'=>'Cómo salir de la lista negra'))?>
                </p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>
</article>
<?php 
$pie = '<div id="menu_footer_texto">'. 
       link_to("Cómo se entra en la lista negra ","nosotros/comoformarnegra", array('title'=>'Cómo se entra en la lista negra')).' - '.
       link_to("Decálogo de la lista negra","nosotros/decalogolistanegra", array('title'=>'Decálogo de la lista negra')).' - '.
       link_to("Cómo salir de la lista negra","nosotros/comosalirlistanegra", array('title'=>'Cómo salir de la lista negra')).' - '.
       link_to("Qué es la lista blanca", "nosotros/listablanca", array('title' => 'Qué es la lista blanca de la Excelencia')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">'.image_tag("img/img_flecha_menu_footer.png", array('title'=>'Ir arriba')).'</a>
   </div>';
slot('nosotros_footer', $pie);
?>