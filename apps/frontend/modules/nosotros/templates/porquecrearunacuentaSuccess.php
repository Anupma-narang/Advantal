<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Qué ventajas te ofrece ser colaborador','tituloSeccion'=>'Qué ventajas te ofrece ser colaborador')) ?>

<article id="content_nosotros_quienes">
    <a name="inicio"></a>
    <h1>Qué ventajas te ofrece ser colaborador</h1>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        Al ser colaborador de la comunidad de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>,<strong> creas tus propias experiencias de cliente</strong>, únicas y memorables.
                    </li>
                    <li>
                        <strong>Ayudas a tus empresas, productos y profesionales favoritos</strong> a mejorar y darte el producto o servicio que quieres.
                    </li>
                    <li>
                        <strong>Contribuyes a nuestras listas</strong> de empresas, productos y profesionales recomendados con tus preferencias.
                    </li>
                    <li>
                        <strong>Recomiendas a tus amigos</strong> los mejores productos, servicios y profesionales.
                    </li>
                    <li>
                        <strong>Recibes reconocimiento social y el prestigio</strong> de pertenecer a una comunidad de consultores en Experiencia de Cliente.
                    </li>
                    <li>
                        Además, <strong>ganas regalos y dinero</strong> con tus ideas.
                    </li>
                </ul>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section> 
    <?php
    $pie = '<div id="menu_footer_texto">' .
            link_to("Inicio", "home/index", array('title' => 'Inicio')) . ' - ' .
            link_to("Concursos", "concurso/index", array('title' => 'Concursos')) . ' - ' .
            link_to("Recompensas", "nosotros/sistema", array('title' => 'Recompensas')) . ' - ' .
            link_to("Cómo ganar puntos", "nosotros/comoganarpuntos2", array('title' => 'Cómo ganar puntos')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
    slot('nosotros_footer', $pie);
    ?>