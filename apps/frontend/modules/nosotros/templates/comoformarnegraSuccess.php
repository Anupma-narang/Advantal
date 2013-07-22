<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Cómo se entra en la lista negra','tituloSeccion'=>'Cómo se entra en la lista negra')) ?>

<article id="content_nosotros_listablanca">
    <a name="inicio"></a>
    <h1>Cómo se entra en la lista negra</h1>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        Para entrar en la lista negra, es necesario primero <strong>ser objeto de un concurso de ideas</strong> organizado por <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>.
                    </li>
                    <li>
                        Tras finalizar éste, la empresa, entidad pública o fabricante del producto en concurso <strong>rechaza la implantación del</strong> <?php echo link_to('Plan de acción', 'nosotros/glosarioterminos#Plan_de_accion', array('class'=>'glosario', 'title'=>'Plan de acción'))?> <strong>de mejora propuesto por</strong> sus clientes, que han contribuido en el mismo como <?php echo link_to('colaboradores', 'nosotros/glosarioterminos#Colaborador', array('class'=>'glosario', 'title'=>'Colaborador'))?> de nuestra Comunidad.
                    </li>
                    <li>
                        Además, la empresa, entidad o fabricante <strong>rechaza también la implantación de cualquier otro plan de mejora alternativo,</strong> en un plazo máximo de 3 meses tras terminar su concurso, que resuelva con éxito las experiencias de cliente insatisfactorias detectadas.
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
       link_to("Cómo no se entra en la lista negra","nosotros/comonoformarnegra", array('title'=>'Cómo no se entra en la lista negra')).' - '.
       link_to("Cómo salir de la lista negra","nosotros/comosalirlistanegra", array('title'=>'Cómo salir de la lista negra')).' - '.
       link_to("Decálogo de la lista negra","nosotros/decalogolistanegra", array('title'=>'Decálogo de la lista negra')).' - '.
       link_to("Concursos", "concurso/index", array('title' => 'Concursos')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">'.image_tag("img/img_flecha_menu_footer.png", array('title'=>'Ir arriba')).'</a>
   </div>';
slot('nosotros_footer', $pie);
?>
