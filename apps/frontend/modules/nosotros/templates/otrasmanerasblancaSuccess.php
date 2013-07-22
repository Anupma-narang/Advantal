<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Otras maneras de entrar en la lista blanca','tituloSeccion'=>'Otras maneras de entrar en la lista blanca')) ?>

<article id="content_nosotros_listablanca">
    <a name="inicio"></a>
    <h1>Otras maneras de entrar en la lista blanca</h1>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    Una empresa, entidad pública o producto, <strong>entra a formar parte de la lista blanca</strong> si cumple las siguientes condiciones:
                </p>
                <ul>
                    <li>
                        Es <strong>objeto de una auditoría</strong> de Experiencia de Cliente, realizada por personal de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> fuera de concurso, que verifica el cumplimiento del <strong>80% o más</strong> de los indicadores de excelencia más relevantes acordados y definidos anteriormente en un <?php echo link_to('cuadro de mando.', 'nosotros/glosarioterminos#Cuadro_de_mando', array('class'=>'glosario','title'=>'Cuadro de mando')) ?>
                    </li>
                    <li>
                        Además, la empresa, entidad o fabricante del producto presenta un <strong>Plan de mejora continua</strong> para, al menos, los próximos 2 años.
                    </li>
                    <li>
                        De <strong>manera excepcional</strong>, podrán formar parte de la lista blanca aquellas empresas, entidades o productos que, sin haber sido objeto de un concurso, <strong>destaquen por su excelencia</strong> en su sector. 
                    </li>
                    <li>
                        Este hecho se confirmará a través de la recepción, mediante correo electrónico, de <strong>500 o más valoraciones positivas argumentadas</strong> por parte de colaboradores de la Comunidad, siempre que exista una proporción respecto a valoraciones negativas de 3 a 1.
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
        link_to("Condiciones para permanecer en la lista blanca","nosotros/comopermanecerblanca", array('title'=>'Condiciones para permanecer en la lista blanca')).' - '.
        link_to("Condiciones para salir de la lista blanca", "nosotros/comosalirblanca", array('title' => 'Condiciones para salir de la lista blanca')) . ' - ' .
        link_to("Nuestro decálogo", "nosotros/decalogo", array('title' => 'Nuestro decálogo')) . ' - ' .
        link_to("Concursos", "concurso/index", array('title' => 'Concursos')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>
