<?php echo include_partial('preguntasfrecuentes/miga', array('nombreSeccion' => 'Puntos y Jerarquías', 'tituloSeccion' => 'Puntos y Jerarquías')) ?>

<a name="inicio"></a>
<h1>Puntos y Jerarquías</h1>
    <?php include_partial('imagensuperior')?>
<nav class="lista_faq">
    <p>
        <a href="#A" target="_self">¿Qué es una Jerarquía?</a>
    </p>
    <p>
        <a href="#B" target="_self">¿Cuántas Jerarquías hay?</a>
    </p>
    <p>
        <a href="#C" target="_self">¿Qué beneficios tiene pertenecer a una Jerarquía?</a>
    </p>
    <p>
        <a href="#D" target="_self">¿Qué es la cuenta de puntos canjeables y puntos acumulados?</a>
    </p>
    <p>
        <a href="#E" target="_self">¿Cuándo pasan a mi cuenta los puntos que he ganado?</a>
    </p>
    <p>
        <a href="#F" target="_self">¿Por qué no pasan a mi cuenta automáticamente los puntos que he ganado?</a>
    </p>
    <p>
        <a href="#G" target="_self">¿Pierdo mis puntos si un concurso es declarado nulo o rechazado?</a>
    </p>
</nav>

<div class="clear"></div>
<section class="border-box-n">
    <a name="A" id="A"></a>
    <h2 class="faq">¿Qué es una Jerarquía?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Una Jerarquía o <strong>"categoría de experto"</strong> es un reconocimiento de la Comunidad, que te indica a ti y al resto de colaboradores, cómo eres de activo y cómo eres de experto en proponer ideas de valor en los concursos en los que contribuyes.
            </p>
            <p>
                La Jerarquía te <strong>posiciona en un ranking</strong> que te distingue en la Comunidad según el número de puntos acumulados que posees, y que puedes <?php echo link_to('ganar', 'nosotros/comoganarpuntos2', array('title' => 'Cómo ganar puntos')) ?> cada vez que realizas una <?php echo link_to("contribución", "nosotros/glosarioterminos#Contribucion", array('class' => 'glosario', 'title' => 'Contribución')) ?>.
            </p>
            <p>
                Para pertenecer a una Jerarquía, necesitas contribuir en la Comunidad de manera frecuente y <strong>conseguir puntos acumulados</strong>.
            </p>
            <p>
                Ten en cuenta que, los <strong>puntos canjeables que has ganado, no tienen ningún valor para determinar tu posición</strong> en el ranking de colaboradores o la Jerarquía a la que perteneces.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="B" id="B"></a>
    <h2 class="faq">¿Cuántas Jerarquías hay?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Te proponemos las siguientes Jerarquías:
            </p>
            <ul>
                <li>
                    <strong>Service Auditor:</strong> colaborador activo, que contribuye con ideas de interés y valor.
                </li>
                <li>
                    <strong>Service Consultant: </strong>colaborador muy activo, que contribuye con ideas innovadoras de gran interés y valor.
                </li>
                <li>
                    <strong>Service Expert:</strong> colaborador experto muy activo, que contribuye con ideas innovadoras de gran interés y valor demostrado, que, además, destaca como referente en la Comunidad.
                </li>
                <li>
                    <strong>Service Champion:</strong> colaborador muy experto, que contribuye con ideas geniales demostradas y que forma parte de nuestro <?php echo link_to('Panel de Expertos', 'preguntasfrecuentes/contrata#D', array('title' => '¿Quién compone nuestro panel de expertos?')) ?>.
                </li>
            </ul>

        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>


<section class="border-box-n">
    <a name="C" id="C"></a>
    <h2 class="faq">¿Qué beneficios tiene pertenecer a una Jerarquía?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Pertenecer a una Jerarquía te ofrece los <strong>siguientes beneficios</strong>:
            </p>
            <ul>
                <li>
                    Pertenecer a una Jerarquía te permite <strong>participar en promociones especiales</strong> y canjear tus puntos canjeables por <strong>regalos exclusivos.</strong>
                </li>
                <li>
                    Si, adicionalmente, llegas a <strong>Service Champion,</strong>  entras a formar <strong>parte del panel de expertos</strong>  asesores de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> y te ofrecemos la posibilidad de participar en <strong>proyectos remunerados.</strong>
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
    <h2 class="faq">¿Qué es la cuenta de puntos canjeables y puntos acumulados?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Como <?php echo link_to("colaborador", "nosotros/glosarioterminos#Colaborador", array('class' => 'glosario', 'title' => 'Colaborador')) ?> de <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> dispones de una cuenta de puntos canjeables y una cuenta de puntos acumulados:
            </p>
            <ul>
                <li>
                    <strong>Cuenta de puntos canjeables:</strong> son los puntos que tienes disponibles para canjear por regalos.
                    <br>
                    <br>
                    Estos puntos <strong>disminuyen cada vez que realizas un canje,</strong> al restarse los que has utilizado. Los puntos canjeables no tienen ningún valor para determinar tu posición en el ranking de colaboradores o la Jerarquía a la que perteneces.
                </li>
                <li>
                    <strong>Cuenta de puntos acumulados:</strong> son los puntos que posees como miembro de nuestra comunidad, determinan tu posición en el ranking de colaboradores y te otorgan la  <span class="link_rojo"><?php echo link_to("Jerarquía", "preguntasfrecuentes/puntosJerarquias#A", array('title' => '¿Qué es una Jerarquía?')) ?></span> a la que perteneces.
                    <br>
                    <strong>Estos puntos no disminuyen nunca<sup>1</sup>.</strong>
                </li>
            </ul>
            <p>
                Cada vez que <?php echo link_to("ganas puntos", "nosotros/comoganarpuntos2", array('title' => 'Cómo ganar puntos')) ?> por contribuir, se acumulan por igual en ambas cuentas.
            </p>
            <p>
                Los puntos canjeables y los puntos acumulados <strong>no caducan nunca</strong>.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>
<div class="pxh20"></div>
        <p class="small" style="margin: 0px 5px;">
    <strong>Nota<sup>1</sup></strong>: excepto en caso de publicar contribuciones que infrinjan las condiciones de participación.
</p>



<section class="border-box-n">
    <a name="E" id="E"></a>
    <h2 class="faq">¿Cuándo pasan a mi cuenta los puntos que he ganado?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Si has ganado puntos por contribuir en nuestra comunidad, ten en cuenta que no todos los puntos <strong>pasan a tu cuenta automáticamente:</strong>
            </p>
            <p>
            <table class="pequena">
                <thead>
                    <tr>
                        <th>
                            Cómo ganar puntos
                        </th>
                        <th>
                            Cuándo pasan a tu cuenta
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="impar">
                        <td>
                            <strong>Auditar en la lista blanca</strong>
                        </td>
                        <td>
                            Automáticamente
                        </td>
                    </tr>
                    <tr class="par">
                        <td>
                            <strong>Recomendarnos a un amigo    </strong>
                        </td>
                        <td>
                            Al darse de alta el amigo como colaborador
                        </td>
                    </tr>
                    <tr class="impar">
                        <td>
                            <strong>Añadir material de apoyo en una contribución (doc., video, foto)</strong>
                        </td>
                        <td>
                            Al validar tu contribución
                        </td>
                    </tr>
                    <tr class="par">
                        <td>
                            <strong>Votar en el Referéndum de un concurso</strong>
                        </td>
                        <td>
                            Automáticamente
                        </td>
                    </tr>
                    <tr class="impar">
                        <td>
                            <strong>Crear una cuenta de colaborador    </strong> 
                        </td>
                        <td>
                            Automáticamente
                        </td>
                    </tr>
                    <tr class="par">
                        <td> 
                            <strong>Contribuir en un concurso   </strong>       
                        </td>
                        <td>
                            Al validar tu contribución
                        </td>
                    </tr>
                    <tr class="impar">
                        <td>
                            <strong>Crear un concurso</strong>
                        </td>
                        <td>
                            Al validar tu contribución
                        </td>
                    </tr>
                    <tr class="par">
                        <td> 
                            <strong>Ser uno de los 3 ganadores de un concurso</strong>
                        </td>
                        <td>
                            Al finalizar el Referéndum
                        </td>
                    </tr>
                    <tr class="impar">
                        <td>
                            <strong>Recomendar a un profesional</strong>
                        </td>
                        <td>
                            Al validar tu contribución
                        </td>
                    </tr>
                    <tr class="par">
                        <td>
                            <strong>Desaprobar a un profesional</strong>
                        </td>
                        <td> 
                            Al validar tu contribución
                        </td>
                    </tr>
                    <tr class="impar">
                        <td> 
                            <strong>Auditarnos a nosotros  </strong>
                        </td>
                        <td>
                            Al validar tu contribución
                        </td>
                    </tr>
                    <tr class="par">
                        <td>
                            <strong>Compartir un caso de éxito</strong>
                        </td>
                        <td>
                            Al validar tu contribución
                        </td>
                    </tr>
                    <tr class="impar">
                        <td>
                            <strong>Contribuir en un concurso con una contribución de gran valor o una idea genial</strong>
                        </td>
                        <td>
                            Al validar tu contribución
                        </td>
                    </tr>
                    <tr class="par">
                        <td>
                            <strong>Publicar contribuciones que infrinjan las condiciones de participación<sup>1</sup></strong>
                        </td>
                        <td>
                            Al validar tu contribución
                        </td>
                    </tr>
                </tbody>
            </table>
        </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>
<div class="pxh20"></div>
        <p class="small" style="margin: 0px 5px;">
    <strong>Nota<sup>1</sup>: </strong>en este caso se restan puntos.
</p>

<section class="border-box-n">
    <a name="F" id="F"></a>
    <h2 class="faq">¿Por qué no pasan a mi cuenta automáticamente los puntos que he ganado?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                En algunos casos, los puntos que ganas por tu contribución pasan a tu cuenta automáticamente. 
            </p>
            <p>
                En otros casos, necesitamos comprobar primero que tu <strong>contribución es interesante</strong> y que nuestra opinión es compartida por los otros colaboradores de la Comunidad.
            </p>
            <p>
                De este modo, aseguramos un sistema de recompensas más justo, que <strong>premia únicamente a las ideas que aportan valor</strong> a las empresas, entidades y productos en concurso.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="G" id="G"></a>
    <h2 class="faq">¿Pierdo mis puntos si un concurso es declarado nulo o rechazado?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                No. Aunque el concurso en que contribuyes sea <strong>declarado</strong> <?php echo link_to("nulo", "preguntasfrecuentes/concursos#J", array('title' => '¿Cuándo se declara nulo un concurso?')) ?> por parte de  <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> o resulte <strong>rechazado</strong> por parte de la empresa, entidad pública o fabricante del producto en concurso, <strong>los puntos que has ganado por contribuir en el mismo hasta ese momento, no los pierdes nunca,</strong> tanto puntos canjeables como acumulados.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>
