<?php use_helper('alternativeLink'); ?>
<?php echo include_partial('preguntasfrecuentes/miga', array('nombreSeccion' => 'Recompensas', 'tituloSeccion' => 'Recompensas')) ?>

<a name="inicio"></a>
<h1>Recompensas</h1>
    <?php include_partial('imagensuperior')?>
<nav class="lista_faq">
    <p>
        <a href="#A" target="_self">¿Cómo vendemos un Plan de acción?</a>
    </p>
    <p>
        <a href="#B" target="_self">¿Qué porcentaje de beneficio repartimos?</a>
    </p>
    <p>
        <a href="#C" target="_self">¿Cuánto dinero puedo ganar si contribuyo?</a>
    </p>
    <p>
        <a href="#D" target="_self">¿Quién tiene derecho a Participación en beneficio?</a>
    </p>
    <p>
        <a href="#E" target="_self">¿Cuándo recibo el dinero de mi Participación en beneficio?</a>
    </p>
    <p>
        <a href="#F" target="_self">¿Cuándo y cómo cobro mis recompensas?</a>
    </p>
    <p>
        <a href="#G" target="_self">¿De qué métodos dispongo para cobrar mis recompensas?</a>
    </p>
    <p>
        <a href="#H" target="_self">¿Cómo se participa en beneficio si hay empate entre varios colaboradores?</a>
    </p>
    <p>
        <a href="#I" target="_self">¿Caducan las recompensas en mi cuenta?</a>
    </p>
</nav>
<div class="clear"></div>
<section class="border-box-n">
    <a name="A" id="A"></a>
    <h2 class="faq">¿Cómo vendemos un Plan de acción?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Vendemos un Plan de acción como <strong>parte inseparable de una de nuestras</strong> <?php echo link_to("vendemos el Plan de acción", "nosotros/nuestros", array('title' => 'Nuestros servicios')) ?>.
            </p>
            <p>
                No vendemos un Plan de acción separado como tal.
            </p>
            <p>
                Si participas en beneficio, el dere de reparto al que tienes derecho se calcula a partir del <strong>valor de venta de la totalidad del servicio</strong>, IVA excluido.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="B" id="B"></a>
    <h2 class="faq">¿Qué porcentaje de beneficio repartimos?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> <strong>compartimos contigo</strong> y con el resto de colaboradores con <?php echo link_to("derecho a Participación en beneficio", "preguntasfrecuentes/recompensas#D", array('title' => '¿Quién tiene derecho a Participación en beneficio?')) ?> el <strong>25% del valor</strong> de la venta<sup>1</sup> del Plan de acción final resultante del concurso en el que contribuyes.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>
<div class="pxh20"></div>
        <p class="small" style="margin: 0px 5px;">
            <strong>Nota<sup>1</sup>: </strong> precio final de venta de la modalidad de servicio contratada, de la que forma parte el Plan de acción, IVA excluido.
        </p>

<section class="border-box-n">
    <a name="C" id="C"></a>
    <h2 class="faq">¿Cuánto dinero puedo ganar si contribuyo?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Cada vez que contribuyes en nuestra comunidad, <strong>ganas puntos canjeables por regalos</strong>.
            </p>
            <p>
                Además, si tu contribución queda clasificada entre las <strong>3 más votadas</strong> en el concurso en que contribuyes, <strong>ganas puntos extra.</strong>
            </p>
            <p>
                ¿Quieres saber <?php echo link_to("cómo ganar puntos", "nosotros/comoganarpuntos2", array('title' => 'Cómo ganar puntos')) ?>?
            </p>
            <p>
                Si, adicionalmente, vendemos el Plan de acción en el que contribuyes como parte de una de nuestras <?php echo link_to("modalidades de servicio", "nosotros/nuestros", array('title' => 'Nuestros servicios')) ?>, te recompensamos con Participación en beneficio, según este modelo de reparto:
            </p>
            <ul>
                <li>
                    48% si tu contribución es la <strong>primera más votada</strong> en el concurso.
                </li>
                <li>
                    24% si tu contribución es la <strong>segunda más votada</strong> en el concurso.
                </li>
                <li>
                    16% si tu contribución es la <strong>tercera más votada</strong> en el concurso.
                </li>
                <li>
                    12% a repartir entre el resto de contribuciones votadas por <strong>5 colaboradores o más y que consigan al menos 10 puntos.</strong>
                </li>
            </ul>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="D" id="D"></a>
    <h2 class="faq">¿Quién tiene derecho a Participación en beneficio?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Tienes derecho a <strong>Participación en beneficio</strong> si:
            </p>
            <ul>
                <li>
                    Tu contribución es una de las <strong>3 más votadas</strong> al finalizar un concurso en el que se ha producido la venta de un <?php echo link_to("Plan de acción", "nosotros/glosarioterminos#Plan_de_accion", array('class' => 'glosario', 'title' => 'Plan de acción')) ?>. 
                </li>
                <li>
                    Tu contribución no es una de las 3 más votadas, pero ha sido <strong>votada por 5 colaboradores o más</strong> y ha conseguido un mínimo de <strong>10 puntos</strong> al finalizar un concurso en el que se ha producido la venta de un Plan de acción.
                </li>
                <li>
                    Si tienes más de una contribución que cumple con los casos anteriores, tu recompensa será la suma de los distintos porcentajes que te correspondan.
                </li>
            </ul>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>
<section class="border-box-n">
    <a name="E" id="E"></a>
    <h2 class="faq">¿Cuándo recibo el dinero de mi Participación en beneficio?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Si <strong>participas en beneficio</strong>, recibirás la cantidad correspondiente en un plazo máximo de <strong>3 días</strong> desde la fecha en que la empresa o entidad en concurso haya abonado a <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> el importe total del servicio prestado.
            </p>
            <p>
                El dinero que recibas se guardará en tu <?php echo link_to("cuenta de colaborador", "nosotros/glosarioterminos#Cuenta_de_colaborador", array('class' => 'glosario', 'title' => 'Cuenta de colaborador')) ?>. Para hacerla efectiva, necesitas <strong>hacer caja</strong>.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="F" id="F"></a>
    <h2 class="faq">¿Cuándo y cómo cobro mis recompensas?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Puedes cobrar tus recompensas económicas en cualquier momento que lo desees, si tienes <strong>30€ ó más</strong> acumulados en tu <?php echo link_to("cuenta de colaborador", "nosotros/glosarioterminos#Cuenta_de_colaborador", array('class' => 'glosario', 'title' => 'Cuenta de colaborador')) ?> y cumples con las condiciones descritas en nuestro sistema de <?php echo link_to("Recompensas", "nosotros/sistema", array('title' => 'Recompensas')) ?>.
            </p>
            <p>
                Sólo necesitas hacer clic en <strong>hacer caja</strong>, que puedes encontrar en <?php echo authenticated_link_to($sf_user, "Mi cuenta", "vosotros/micuenta", "Mi cuenta", "nosotros_lightboxes/accesocuenta", array('title' => 'Mi cuenta'), array('title' => 'Mi cuenta', 'class' => 'lightbox-i')) ?>.
            </p>
            <p>
                Puedes <strong>canjear un regalo</strong> en cualquier momento que lo desees, si tienes los puntos canjeables suficientes.
            </p>
            <p>
                Sólo necesitas hacer clic en <strong>canjea regalo</strong>, que puedes encontrar en <strong>Mi cuenta</strong> o en el Escaparate de regalos.
            </p>
            <p>
                Ten en cuenta que existe un <a href="#I" target="_self" title="¿Caducan las recompensas en mi cuenta?">plazo límite</a> para el cobro de recompensas económicas.
            </p>
            <p>
                No existe ningún plazo límite para el canje de regalos.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="G" id="G"></a>
    <h2 class="faq">¿De qué métodos de cobro dispongo para cobrar mis recompensas?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Ponemos a tu disposición los siguientes <strong>métodos de cobro</strong> de recompensas:
            </p>
            <ul>
                <li>
                    <strong>Abono por transferencia</strong>
                </li>
                <li>

                    <strong>Paypal</strong> 
                </li>
            </ul>
            <p>
                Para indicarnos cuál es el método de cobro que prefieres, sólo necesitas entrar en <?php echo authenticated_link_to($sf_user, "Mi cuenta", "vosotros/micuenta", "Mi cuenta", "nosotros_lightboxes/accesocuenta", array('title' => 'Mi cuenta'), array('title' => 'Mi cuenta', 'class' => 'lightbox-i')) ?>.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>             

<section class="border-box-n">
    <a name="H" id="H"></a>
    <h2 class="faq">¿Cómo se participa en beneficio si hay empate entre varios colaboradores?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                En caso de producirse un empate en alguno de los 3 puestos más votados ("ganadores ex aequo") en un concurso, el reparto de Participación en beneficio se realizará de la siguiente manera: 
            </p>
            <p>
            <ul>
                <li>
                    <strong>1) Empate de más de una contribución en el 1er puesto</strong>
                    <br><br>
                    El porcentaje de reparto de Participación en beneficio, asignado normalmente a la 2ª contribución más votada, se sumará a la asignada a la 1ª más votada. La cantidad resultante se dividirá, a partes iguales, entre las contribuciones que han empatado en el 1er puesto.
                    <br><br>
                    La siguiente contribución más votada recibirá la recompensa asignada normalmente al 3er puesto.
                    <br><br>
                    El resto del porcentaje de Participación en beneficio a repartir se dividirá entre las contribuciones con <a href="#D" target="_self" title="¿Quién tiene derecho a Participación en beneficio?">derecho a Participación en beneficio</a>, a partes iguales.
                </li>
                <li>
                    <strong>2) Empate de más de una contribución en el 2º puesto</strong>
                    <br><br>
                    El porcentaje de reparto de Participación en beneficio, asignado normalmente a la 3ª contribución más votada, se sumará a la asignada a la 2ª más votada. La cantidad resultante se dividirá, a partes iguales, entre las contribuciones que han empatado en el 2º puesto.
                    <br><br>
                    El resto del porcentaje de Participación en beneficio a repartir se dividirá entre las contribuciones con <a href="#D" target="_self" title="¿Quién tiene derecho a Participación en beneficio?">derecho a Participación en beneficio</a>, a partes iguales.
                </li>
                <li>
                    <strong>3) Empate de más de una contribución en el 3er puesto</strong>
                    <br><br>
                    El porcentaje de reparto de Participación en beneficio, asignado normalmente a las contribuciones que han conseguido votos de al menos cinco (5) colaboradores y diez (10) puntos o más, se dividirá, a partes iguales, entre las clasificadas en el 3er puesto.
                    <br><br>
                    El resto de colaboradores con derecho al cobro no percibirán Participación en beneficio en este caso.
                </li>
            </ul>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="I" id="I"></a>
    <h2 class="faq">¿Caducan las recompensas en mi cuenta?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Los <strong>puntos canjeables y acumulados</strong> que has ganado no caducan nunca.
            </p>
            <p>
                Las <strong>recompensas económicas</strong> que tienes acumuladas en tu cuenta y superan los 30 € sí caducan, por lo que ten en cuenta lo siguiente:
            </p>
            <p>
            <ul>
                <li>
                    Dispones de un plazo máximo de <strong>6 meses</strong> desde la última vez que participaste en beneficio para hacer caja.
                </li>
                <li>
                    Una vez finalizado este plazo de 6 meses, si no haces caja, <strong>todo el dinero no cobrado se convertirá en puntos canjeables</strong> (pero no acumulables), a razón de 100 puntos por cada 1€ acumulado.
                </li>
            </ul>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>
