<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Condiciones para permanecer en la lista blanca','tituloSeccion'=>'Condiciones para permanecer en la lista blanca')) ?>

<article id="content_nosotros_listablanca">
    <a name="inicio"></a>
    <h1>Condiciones para permanecer en la lista blanca </h1>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    Una empresa, entidad pública o producto <strong>permanece indefinidamente en la lista blanca</strong> si cumple las siguientes condiciones:
                </p>
                <ul>
                    <li>
                        Sus clientes <strong>auditan públicamente su evolución</strong> de manera continua y constante, como <?php echo link_to("colaboradores", "nosotros/glosarioterminos#Colaborador", array('class'=>'glosario', 'title'=>'Colaborador')) ?> de nuestra Comunidad, asegurando que cumple con los indicadores de excelencia establecidos y que se ajusta a las necesidades de los consumidores.
                    </li>
                    <li>
                        Mantiene una <strong>categoría de excelencia de medalla de bronce o superior</strong>, de manera estable y a lo largo del tiempo.
                    </li>
                    <li>
                        Si una empresa, entidad o producto que ha dejado de formar parte de la lista blanca, desea volver a formar parte de la misma, <strong>deberá presentar a la Comunidad de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> un Plan de acción de mejora</strong> que resuelva las incidencias detectadas, en un plazo máximo de 3 meses desde su salida de la lista.
                    </li>
                    <li>
                        En el momento en que una empresa, entidad pública o producto deja de formar parte de la lista blanca, <strong>puede volver a ser objeto de concurso,</strong> si así lo deciden sus clientes como colaboradores de nuestra Comunidad, con el objetivo de <strong>proponer las mejoras necesarias.</strong>
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
        link_to("Condiciones para salir de la lista blanca", "nosotros/comosalirblanca", array('title' => 'Condiciones para salir de la lista blanca')) . ' - ' .
        link_to("Otras maneras de entrar en la lista blanca", "nosotros/otrasmanerasblanca", array('title' => 'Otras maneras de entrar en la lista blanca')) . ' - ' .
        link_to("Decálogo de la lista blanca", "nosotros/decalogolistablanca", array('title' => 'Decálogo de la lista blanca')) . ' - ' .
        link_to("Concursos", "concurso/index", array('title' => 'Concursos')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>
