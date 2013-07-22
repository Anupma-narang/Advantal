<?php use_helper('alternativeLink');?>
<?php echo include_partial('preguntasfrecuentes/miga', array('nombreSeccion' => 'Alta y baja de servicio', 'tituloSeccion' => 'Alta y baja de servicio')) ?>

<a name="inicio"></a>
<h1>Alta y baja de servicio</h1>
    <?php include_partial('imagensuperior')?>
<nav class="lista_faq">
    <p>
        <a href="#A" target="_self">¿Cómo puedo ser colaborador?</a>
    </p>
    <p>
        <a href="#G" target="_self">¿Por qué crear una cuenta?</a>
    </p>
    <p>
        <a href="#B" target="_self">¿Cómo puedo crear una cuenta?</a>
    </p>
    <p>
        <a href="#C" target="_self">¿Cómo puedo darme de baja?</a>
    </p>
    <p>
        <a href="#D" target="_self">¿Cómo puedo darme de baja de las comunicaciones comerciales?</a>
    </p>
    <p>
        <a href="#E" target="_self">¿Qué pasa con mis recompensas cuando me doy de baja?</a>
    </p>
    <p>
        <a href="#F" target="_self">¿Puedo reactivar mi cuenta una vez me he dado de baja?</a>
    </p>
</nav>

<div class="clear"></div>

<!--                                    <div id="conten_overflow_5">-->
<section class="border-box-n">
    <a name="A" id="A"></a>
    <h2 class="faq">¿Cómo puedo ser colaborador?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Para ser colaborador, lo único que necesitas es tener <strong>buenas ideas</strong> sobre cómo mejorar tus productos, servicios y profesionales favoritos, querer <strong>ganar dinero</strong> y <?php echo link_to("crear una cuenta", "sfApply/apply", array('title' => 'crea una cuenta')) ?> .
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="G" id="G"></a>
    <h2 class="faq">¿Por qué crear una cuenta?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Convertirte en <strong>colaborador</strong> de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> te ofrece las siguientes ventajas:
            </p>
            <ul>
                <li>
                    <strong>Crear concursos.</strong>
                </li>
                <li>
                    <strong>Contribuir</strong> en concursos ya existentes.
                </li>
                <li>
                    <strong>Votar</strong> en Referéndums.
                </li>
                <li>
                    <strong>Recomendar o desaprobar</strong> profesionales.
                </li>
                <li>
                    <strong>Auditar</strong> en la lista blanca.
                </li>
                <li>
                    Participar en <strong>promociones.</strong>
                </li>
                <li>
                    <strong>Personalizar</strong> la apariencia de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>.
                </li>
                <li>
                    <strong>Pertenecer a una Jerarquía</strong> en el ranking de colaboradores.
                </li>
                <li>
                    <strong>Ganar puntos</strong> canjeables por regalos.
                </li>
                <li>
                    <strong>Participar en beneficio.</strong>
                </li>
            </ul>
            <p>
                Y además, sólo por unirte a nosotros, te regalamos <strong>100 puntos</strong> para que empieces a ganar.
            </p>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
</section>

<section class="border-box-n">
    <a name="B" id="B"></a>
    <h2 class="faq">¿Cómo puedo crear una cuenta?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Crear una cuenta de <?php echo link_to("colaborador", "nosotros/glosarioterminos#Colaborador", array('class' => 'glosario', 'title'=>'Colaborador')) ?> es muy fácil.
            </p>
            <p>
                Sólo necesitas ir a la página de Inicio, hacer clic en <?php echo link_to("crea una cuenta", "sfApply/apply", array('title' => 'crea una cuenta')) ?> y seguir las instrucciones.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="C" id="C"></a>
    <h2 class="faq">¿Cómo puedo darme de baja?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                ¿Has decidido realmente darte de baja de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>? ¡Umm! Nos da mucha pena y te vamos a echar mucho de menos, pero te lo queremos poner fácil.
            </p>
            <p>
                Solamente necesitas entrar en <strong><?php echo authenticated_link_to($sf_user, "Mi cuenta", "vosotros/baja_colaborador", "Mi cuenta", "nosotros_lightboxes/accesocuenta", array('title' => 'Mi cuenta'), array('title' => 'Mi cuenta', 'class'=>'lightbox-i')) ?></strong> y hacer clic en "darme de baja".
            </p>
            <p>
                También te puedes dar de baja enviándonos una solicitud escrita por correo postal, acompañada de la fotocopia por las 2 caras de tu DNI o pasaporte.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>
<section class="border-box-n">
    <a name="D" id="D"></a>
    <h2 class="faq">¿Cómo puedo darme de baja de las comunicaciones comerciales?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Para solicitar la baja de las comunicaciones comerciales, sólo necesitas enviar un correo electrónico con asunto "baja" a la dirección <a href="mailto:privacidad@auditoscopia.com" title="privacidad@auditoscopia.com">privacidad@auditoscopia.com</a>.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>


<section class="border-box-n">
    <a name="E" id="E"></a>
    <h2 class="faq">¿Qué pasa con mis recompensas cuando me doy de baja?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Si deseas darte de baja de nuestra comunidad y tienes en tu cuenta <strong>30€</strong> o más y/o la cantidad de puntos canjeables suficiente para canjearlos por un regalo, es necesario que <strong>hagas caja o realices el canje antes de darte de baja</strong>.
            </p>
            <p>
                Cuando te das baja, pierdes todo el dinero acumulado, así como los puntos de tu cuenta en los siguientes casos:
            </p>
            <ul>
                <li>
                    Tu caja es <strong>inferior a 30 €.</strong>
                </li>
                <li>
                    <strong>Tus puntos canjeables no son suficientes</strong> para canjearlos por el regalo de tu preferencia.
                </li>
                <li>
                    <strong>No solicitas hacer caja o el canje de puntos</strong> antes de darte de baja.
                </li>
            </ul>
            <p>
                También necesitas saber que, cuando te das de baja, <strong>pierdes cualquier otro derecho</strong> adquirido hasta entonces en la Comunidad.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>     
<section class="border-box-n">
    <a name="F" id="F"></a>
    <h2 class="faq">¿Puedo reactivar mi cuenta una vez me he dado de baja?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                No, lamentablemente <strong>no puedes reactivar tu cuenta</strong> una vez te has dado de baja, ya que nosotros no guardamos tus datos cuando dejas de ser colaborador.
            </p><p>
                Si deseas ser colaborador otra vez, necesitas <?php echo link_to("crear una cuenta", "sfApply/apply", array('title'=>'crea una cuenta')) ?>.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>



