<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Condiciones para salir de la lista blanca','tituloSeccion'=>'Condiciones para salir de la lista blanca')) ?>


<article id="content_nosotros_listablanca">
    <a name="inicio"></a>
    <h1>Condiciones para salir de la lista blanca </h1>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    Una empresa, entidad pública o producto <strong>deja de formar parte de la lista blanca</strong> en las siguientes circunstancias:
                </p>
                <ul>
                    <li>
                        En el momento en que su categoría de excelencia se sitúa por <strong>debajo de la medalla de bronce, durante un periodo continuado de 3 meses</strong> y no presenta un Plan de acción de mejora, en el plazo de 90 días, que resuelva las experiencias insatisfactorias detectadas.
                    </li>
                    <li>
                        Cuando <strong>se crea un concurso que retoma una experiencia insatisfactoria relevante</strong>, expuesta en un concurso anterior, y que debería estar solucionada tras la implantación del Plan de acción propuesto.
                    </li>
                    <li>
                        En el momento en el que se crea un concurso donde se comunica <strong>una nueva incidencia relevante, no detectada</strong> hasta la fecha.
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
       link_to("Condiciones para permanecer en la lista blanca","nosotros/comopermanecerblanca", array('title'=>'Condiciones para permanecer en la lista blanca')).' - '.
       link_to("Otras maneras de entrar en la lista blanca","nosotros/otrasmanerasblanca", array('title'=>'Otras maneras de entrar en la lista blanca')).' - '.
       link_to("Decálogo de la lista blanca","nosotros/decalogolistablanca", array('title'=>'Decálogo de la lista blanca')).' - '.
       link_to("Concursos", "concurso/index", array('title' => 'Concursos')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">'.image_tag("img/img_flecha_menu_footer.png", array('title'=>'Ir arriba')).'</a>
   </div>';
slot('nosotros_footer', $pie);
?>
