<?php use_helper('alternativeLink'); ?>
<?php use_stylesheet('caja.css') ?>
<?php //use_stylesheet('global.css')  ?>
<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'Audítanos', 'tituloSeccion' => 'Audítanos')) ?>

<article id="content_nosotros_quienes">
    <a name="inicio"></a>
    <h1>Audítanos</h1>
    <section class="entradila"><?php echo image_tag("img/static/Audítanos_mejorar_experiencia_cliente_auditoscopia.jpg", array('class' => 'right', 'style' => 'vertical-align:middle', 'alt' => 'Audítanos para mejorar tu experiencia de cliente con auditoscopia.', 'title' => 'Audítanos para mejorar tu experiencia de cliente con auditoscopia')); ?>
        <p class="img_220">
            ¿Conoces el refrán "En casa del herrero......?"
            <br>
            Si crees que hay algo que necesitamos mejorar, cambiar o suprimir, por favor, 
            <a href="#user_login_box" id="user_login_box_anchor" class="lightbox-i" title="Audita a auditoscopia">audítanos</a> 
            <strong>también a nosotros</strong> para que nos ajustemos a tus necesidades y expectativas.
            <br>
            <strong>Envíanos tu Plan de acción con tus propuestas</strong> para que nosotros también mejoremos.
        </p>


        <div class="clear"></div>
    </section>
    <h2>¿Qué beneficios consigues al auditarnos a nosotros?</h2>
    <section class="postit">
        <div class="postit1">
            <div class="header">
                <p>
                    Mejoras la comunidad
                </p>
            </div>
            <div class="body bold">
                <p>
                    Contribuyes a la mejora de nuestra comunidad, para tener más fuerza y poder mejorar tu experiencia de cliente.
                </p>
            </div>
            <div class="globo" style="background-image: url('/images/bocadillos/auditanos/mejoraslacomunidad.png'); padding-top: 65px;">
                <p>
                    Así <strong>damos ejemplo</strong> a otros de que la Excelencia es posible.
                </p>
            </div>
        </div>
        <div class="postit2">
            <div class="header">
                <p>
                    Ayudas a otros
                </p>
            </div>
            <div class="body bold">
                <p>
                    Ayudas a otros colaboradores a satisfacer sus necesidades y expectativas al comprar un producto o recibir un servicio.
                </p>
            </div>
            <div class="globo" style="background-image: url('/images/bocadillos/auditanos/ayudasaotros.png'); padding-bottom: 15px;padding-top: 107px;">
                <p>
                    Ayudas a mejorar la <strong>experiencia de cliente colectiva.</strong>
                </p>
            </div>
        </div>
        <div class="postit3">
            <div class="header" style="margin-left: -25px;">
                <p>
                    Propones novedades
                </p>
            </div>
            <div class="body bold">
                <p>
                    Propones qué promociones, funcionalidades u otros elementos nuevos te podemos ofrecer para hacer tu contribución más beneficiosa.
                </p>
            </div>
            <div class="globo" style="background-image: url('/images/bocadillos/auditanos/proponesnovedades.png'); padding-top: 110px; padding-bottom: 15px; width: 145px">
                <p>                    
                    Y para empezar, te <strong>recompensamos con 100 puntos</strong> por auditarnos, que puedes sumar a los que ya tienes y canjearlos por regalos.
                </p>
            </div>
        </div>
    </section> 
    <div class="clear"></div>
    <section class="hazte_colaborador">
        <p>
            Tú formas parte de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>:
            <span class="subtitulo_haztecolaborador">¡Hazte colaborador!</span>
        </p>        
    </section>
</article>

<?php
$pie = '<div id="menu_footer_texto">' .
        link_to("Inicio", "home/index", array('title' => 'Inicio')) . ' - ' .
        link_to("Quiénes somos", "nosotros/quienes", array('title' => 'Quiénes somos')) . ' - ' .
        link_to("Cómo funcionamos", "nosotros/como", array('title' => 'Cómo funcionamos')) . ' - ' .
        link_to("Nuestro decálogo", "nosotros/decalogo", array('title' => 'Nuestro decálogo')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>



<!-- el lightbox para avisar al usuario - concurso-->
<div style="display: none">
    <div id="Not_authenticated_dialog_concurso">
        <div class="border-box">
            <div class="header-left">             
                <div class="header-right"></div>         
            </div>
            <div class="top-left">
                <div class="top-right">
                    <p>Para crear un concurso <strong>necesitas ser colaborador</strong>.</p>
                    <ul class="bundle">
                        <li><?php echo link_to('ya soy colaborador.', 'concurso/new/tipo/empresa') ?>
                        </li>
                        <li>¿Aún no eres colaborador? ¡<?php echo link_to('Crea una cuenta', '@apply') ?>
                            ahora!
                        </li>
                    </ul>
                    <br/>
                </div>
            </div>
            <div class="bottom-left">
                <div class="bottom-right"></div>
            </div>
        </div>
    </div>
</div>
<div class="hidden" id="user_messagebox">
    <div class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div>
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

<div class="content pequeno hidden " id="user_login_box">
    <section class="border-box-n b-alert">
        <div class="header-left"><div class="header-right"></div></div>
        <div class="top-left">
            <div class="top-right">
                <p>Para <strong>auditarnos</strong> necesitas ser colaborador.</p>
                <ul class="bundle">
                    <li>
                        <a href="/guard/login?redirect=/nosotros/auditanos" title="ya soy colaborador">ya soy colaborador.</a></li>
                    <li>
                        ¿Aún no eres colaborador? ¡<a href="/registro" target="_blank" title="Crea una cuenta">Crea una cuenta</a> ahora!
                    </li>
                </ul>
                <br>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#user_messagebox").fancybox({padding: 5});
        $("#Not_authenticated").fancybox({padding: 0});
  
        $("#user_login_box_anchor").bind('click', function(){
            if(<?php echo $sf_user->isAuthenticated() ? 1 : 0 ?>){
                //$("#user_login_box_anchor").attr('href','/nosotros/auditanos');
                window.location = '/nosotros/auditanos';
            }else{
                $("#user_login_box_anchor").fancybox({padding: 5});
            }
        });
  
  
  
        if(<?php echo $sf_user->hasFlash('audit') ? 1 : 0 ?>){
            $('#user_message_content').html('<?php echo html_entity_decode($sf_user->getFlash('audit')) ?>');
            $("#user_messagebox").trigger('click');
        }
    });

</script>
