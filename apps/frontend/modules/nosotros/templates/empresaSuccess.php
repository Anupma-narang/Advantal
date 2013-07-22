<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'Contrátanos', 'tituloSeccion' => 'Contrátanos')) ?>

<article id="content_nosotros_empresa">
    <a name="inicio"></a>
    <h1>Contrátanos</h1>

    <section>
        <?php echo image_tag("img/static/Adaptarse_necesidades_preferencias_clientes.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'Ajustarse a las necesidades y expectativas de los clientes', 'title' => 'Adaptarse a las necesidades y prefencias de los clientes')) ?>     
        <p class="img_220">
            Si eres una empresa, una entidad pública o un fabricante y deseas que tus productos o servicios <strong>se ajusten perfectamente a las necesidades y expectativas de tus clientes...</strong>
        </p>
    </section>
    <div class="clear"></div>
    <div class="sustituto_epigrafe"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    Si necesitas reforzar tu capacidad para <strong>producir a tus usuarios una experiencia de cliente plenamente satisfactoria, única e irrepetible...</strong>
                </p>
                <p>
                    No dudes en contactar con nosotros para que <strong>te ayudemos a mejorar y alcanzar los siguientes objetivos:</strong>
                </p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>
    <div class="pxh20"></div>
    <section class="postit" style="margin-top: 10px;">
        <div class="postit1">
            <div class="header">
                <p>
                    Mejorar según necesidades 
                </p>
            </div>
            <div class="body bold">
                <p>
                    Conocer las necesidades, preferencias y expectativas de tus clientes. 
                </p>
                <p>
                    Mejorar tus productos o servicios. 
                </p>
            </div>
        </div>
        <div class="postit2">
            <div class="header">
                <p>
                    Clientes satisfechos
                </p>
            </div>
            <div class="body bold">
                <p>
                    Producir a tus clientes experiencias únicas y memorables. 
                </p>
                <p>
                    Conseguir que tus clientes se identifiquen contigo. 
                </p>
            </div>
            <div class="globo" style="background-image: url('/images/bocadillos/contratanos/contratanos.png'); padding-top: 95px;">
                <p>
                    Tener <strong>clientes satisfechos</strong> que te recomiendan.
                </p>
            </div>
        </div>
        <div class="postit3">
            <div class="header" style="margin-left: -25px;">
                <p>
                    Más y mejor negocio
                </p>
            </div>
            <div class="body bold">
                <p>
                    Implantar una política de excelencia y mejora continua. 
                </p>
                <p>
                    Identificar nuevas oportunidades de negocio. 
                </p>
            </div>
        </div>
    </section>
    <div class="clear"></div>
    <h2>¿Cómo contratar nuestros servicios?</h2>

    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        Si eres una <strong>empresa, entidad pública, fabricante o profesional,</strong> por favor, haz clic <?php echo link_to('aquí', 'nosotros/contratanos', array('title' => 'Formulario de contratación')) ?>.
                    </li>
                </ul>
                <p>
                    ¡Muchas gracias por tu confianza!
                </p>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>

</article>
<div class="hidden" id="user_messagebox">
    <div class="border-box-n">
        <div class="top-left">
            <div class="top-right" id="user_message_content">
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>
</div>
<a href="#user_messagebox" class="hidden" id="user_message_ancor">message box</a>
<script type="text/javascript">
    $(document).ready(function() {
        $("#user_messagebox").fancybox({padding: 5});
        $("#Not_authenticated").fancybox({padding: 0});
  
        if(<?php echo $sf_user->hasFlash('contratanos') ? 1 : 0 ?>){
            $('#user_message_content').html('<?php echo html_entity_decode($sf_user->getFlash('contratanos')) ?>');
            $("#user_messagebox").trigger('click');
        }
    }); 
</script>
<?php
$pie = '<div id="menu_footer_texto">' .
        link_to("Inicio", "home/index", array('title' => 'Inicio')) . ' - ' .
        link_to("Concursos", "concurso/index", array('title' => 'Concursos')) . ' - ' .
        link_to("Quiénes somos", "nosotros/quienes", array('title' => 'Quiénes somos')) . ' - ' .
        link_to("Nuestros servicios", "nosotros/nuestros", array('title' => 'Nuestros servicios')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>
