<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Cómo entrar en la lista blanca','tituloSeccion'=>'Cómo entrar en la lista blanca')) ?>

<article id="content_nosotros_listablanca">
    <a name="inicio"></a>
    <h1>Cómo entrar en la lista blanca</h1>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        Para entrar en la lista blanca, es necesario primero ser <strong>objeto de un concurso de ideas</strong> organizado por <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>.
                    </li>
                    <li>
                        Tras finalizar éste, la empresa, entidad pública o fabricante del producto en concurso necesita <strong>implantar con éxito el</strong> <?php echo link_to('Plan de acción', 'nosotros/glosarioterminos#Plan_de_accion', array('class'=>'glosario', 'title'=>'Plan de acción'))?> <strong>de mejora propuesto por</strong> sus clientes, que han contribuido en el mismo como <?php echo link_to('colaboradores', 'nosotros/glosarioterminos#Colaborador', array('class'=>'glosario', 'title'=>'Colaborador'))?> de nuestra comunidad.
                    </li>
                    <li>
                        Una empresa, entidad pública o producto también forma parte de la lista blanca si pone en práctica <strong>cualquier otro plan de mejora alternativo, en un plazo máximo de 3 meses tras terminar su concurso</strong>, que resuelva con éxito las experiencias de cliente insatisfactorias detectadas.
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
       link_to("Condiciones para permanecer en la lista blanca","nosotros/comopermanecerblanca", array('title'=>'Condiciones para permanecer en la lista blanca')).' - '.
       link_to("Otras maneras de entrar en la lista blanca","nosotros/otrasmanerasblanca", array('title'=>'Otras maneras de entrar en la lista blanca')).' - '.
       link_to("Concursos", "concurso/index", array('title' => 'Concursos')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">'.image_tag("img/img_flecha_menu_footer.png", array('title'=>'Ir arriba')).'</a>
   </div>';
slot('nosotros_footer', $pie);
?>
