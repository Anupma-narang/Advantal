<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Cómo no se entra en la lista negra','tituloSeccion'=>'Cómo no se entra en la lista negra')) ?>

<article id="content_nosotros_listablanca">
    <a name="inicio"></a>
    <h1>Cómo no se entra en la lista negra</h1>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    Formar parte de la lista negra no es un criterio arbitrario ni casual. 
                </p>
                <p>
                    <strong>No se entra a formar parte de la lista negra:</strong>
                </p>
                <ul>
                    <li>
                        Si una empresa, entidad pública o producto no ha sido primero <strong>objeto de un concurso de ideas</strong> organizado por la comunidad de  <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>, siguiendo los procedimientos que rigen la web.
                    </li>
                    <li>
                        <strong>Por recomendación caprichosa</strong> o <?php echo link_to('feedback', 'nosotros/glosarioterminos#Feedback', array('class'=>'glosario', 'title'=>'Feedback'))?> negativo de un colaborador o conjunto de colaboradores, sin causa justificada.
                    </li>
                    <li>
                        Por recomendación negativa de un colaborador o conjunto de colaboradores que, aun con causa justificada, <strong>no aporten la documentación de apoyo</strong> requerida que lo respalde (<?php echo link_to('Incidencia', 'nosotros/glosarioterminos#Incidencia', array('class'=>'glosario', 'title'=>'Incidencia'))?> y <?php echo link_to('Plan de acción', 'nosotros/glosarioterminos#Plan_de_accion', array('class'=>'glosario', 'title'=>'Plan de acción'))?>)
                    </li>
                    <li>
                        Por recomendación negativa de un colaborador o conjunto de colaboradores que, aun con causa justificada y aportando toda la documentación de apoyo pertinente, <strong>no cumplan con los procedimientos que rigen la web.</strong>
                    </li>
                    <li>
                        Por <strong>recomendación maliciosa o malintencionada de otra empresa,</strong> entidad o conjunto de empresas consideradas como competencia directa, aun con causa justificada y aportando la documentación de apoyo pertinente.
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
       link_to("Cómo salir de la lista negra","nosotros/comosalirlistanegra", array('title'=>'Cómo salir de la lista negra')).' - '.
       link_to("Decálogo de la lista negra","nosotros/decalogolistanegra", array('title'=>'Decálogo de la lista negra')).' - '.
       link_to("Por qué existimos","nosotros/porque", array('title'=>'Por qué existimos')).' - '.
       link_to("Concursos", "concurso/index", array('title' => 'Concursos')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">'.image_tag("img/img_flecha_menu_footer.png", array('title'=>'Ir arriba')).'</a>
   </div>';
slot('nosotros_footer', $pie);
?>
