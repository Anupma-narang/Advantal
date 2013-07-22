<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'Qué es el Directorio de buenos profesionales', 'tituloSeccion' => 'Qué es el Directorio de buenos profesionales')) ?>

<article id="content_nosotros_comofuncionamos">

    <a name="inicio"></a>
    <h1>Qué es el Directorio de buenos profesionales</h1> 
    <h2>Guía de profesionales recomendados</h2>

    <section><?php echo image_tag("img/static/Guía_profesionales_recomendados_excelencia.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'Guía de profesionales recomendados por su excelencia', 'title' => 'Guía de profesionales recomendados por su excelencia')); ?>
        <p class="img_220">
            El Directorio de buenos profesionales consiste en una <strong>guía de profesionales</strong> de diferentes actividades, que <strong>sus clientes recomiendan por sus buenas prácticas y excelencia</strong> en el servicio.
        </p>
        <div class="clear"></div>
    </section>
    <h2>¿Qué objetivos persigue el Directorio?</h2>

    <section class="postit">
        <div class="postit1">
            <div class="header">
                <p>
                    Auditoría continua
                </p>
            </div>
            <div class="body bold">
                <p>
                    Crear un mecanismo de seguimiento y auditoría continua de buenas prácticas profesionales.
                </p>
            </div>
        </div>
        <div class="postit2">
            <div class="header">
                <p>
                    Hacer público la Excelencia
                </p>
            </div>
            <div class="body bold">
                <p>
                    Hacer público los profesionales que destacan por su excelencia y buenas prácticas.
                </p>
                <p>
                    Servir de referencia a otros consumidores
                </p>
            </div>
        </div>
        <div class="postit3">
            <div class="header" style="margin-left: -25px;">
                <p>
                    Asegurar la Excelencia
                </p>
            </div>
            <div class="body bold">
                <p>
                    Asegurar la Excelencia y permitir corregir desviaciones de manera dinámica.
                </p>
            </div>
        </div>
    </section>
    <div class="clear"></div>
    <h2>Recomendación y desaprobación de profesionales</h2>
    <section class="border-box-n">        
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    Estos profesionales están recomendados porque se ajustan a las necesidades y expectativas de sus usuarios, y les producen una <?php echo link_to('experiencia de cliente plenamente satisfactoria', 'preguntasfrecuentes/contribuir#C', array('title' => '¿Qué es una experiencia de cliente satisfactoria?')) ?>, única e irrepetible.
                </p>
                <p>
                    Un profesional puede ser <?php echo link_to('recomendado', 'preguntasfrecuentes/auditarListas#G', array('title' => '¿Qué es recomendar a un profesional?')) ?> o <?php echo link_to('desaprobado', 'preguntasfrecuentes/auditarListas#H', array('title' => '¿Qué es desaprobar a un profesional?')) ?> mediante un sistema de <?php echo link_to('cartas de recomendación', 'preguntasfrecuentes/auditarListas#I', array('title' => '¿Qué es una carta de recomendación?')) ?> y <?php echo link_to('cartas de desaprobación', 'preguntasfrecuentes/auditarListas#J', array('title' => '¿Qué es una carta de desaprobación?')) ?>, en relación al servicio prestado a sus clientes, teniendo en cuenta los <strong>aspectos relevantes para el propio usuario</strong> (conocimientos, atención, trato, etc.).
                </p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>
    <h2>Seguimiento y valoración continua de profesionales </h2>
    <section class="border-box-n">

        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    El sistema de valoración mediante cartas hace posible que el profesional sea <strong>auditado a lo largo del tiempo</strong>, y reciba un <?php echo link_to('feedback', 'nosotros/glosarioterminos#Feedback', array('class'=>'glosario', 'title'=>'Feedback'))?> constante de sus clientes con propuestas de mejora, con el fin de ajustarse a las necesidades cambiantes de los consumidores.
                </p>
                <p>
                    Esta <strong>interacción y participación dinámica de los usuarios</strong> en la mejora continua del profesional, facilita un reajuste permanente de expectativas y el mantenimiento de la excelencia alcanzada.
                </p>
                <p>
                    Cada recomendación o desaprobación de un profesional está <strong>recompensada con puntos canjeables por regalos,</strong> siguiendo el modelo y condiciones descritas en nuestro sistema de <?php echo link_to('puntos y Jerarquías', 'nosotros/jerarquias', array('title' => 'Puntos y Jerarquías')) ?>
                </p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>
</article>
<?php
$pie = '<div id="menu_footer_texto">' .
        link_to("Inicio", "home/index", array('title' => 'Inicio')) . ' - ' .
        link_to("Cómo funciona el Directorio", "preguntasfrecuentes/auditarListas#K", array('title' => '¿Cómo funciona el Directorio de buenos profesionales?')) . ' - ' .
        link_to("Qué es la lista blanca", "nosotros/listablanca", array('title' => 'Qué es la lista blanca de la Excelencia')) . ' - ' .
        link_to("Qué es la lista negra", "nosotros/listanegra", array('title' => 'Qué es la lista negra de la Excelencia')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>