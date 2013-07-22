<?php echo include_partial('preguntasfrecuentes/miga', array('nombreSeccion' => 'Concursos', 'tituloSeccion' => 'Concursos')) ?>

<a name="inicio"></a>
<h1>Concursos</h1>
    <?php include_partial('imagensuperior')?>
<nav class="lista_faq">
    <p>
        <a href="#A" target="_self">¿Qué es un concurso?</a>
    </p>
    <p>
        <a href="#B" target="_self">¿Cómo funciona un concurso?</a>
    </p>
    <p>
        <a href="#C" target="_self">¿Qué hace falta para crear un concurso?</a>
    </p>
    <p>
        <a href="#D" target="_self">¿Cómo puedo crear un concurso?</a>
    </p>
    <p>
        <a href="#E" target="_self">¿Cómo puedo contribuir en un concurso?</a>
    </p>
    <p>
        <a href="#F" target="_self">¿Por qué hay una parte pública y una parte privada?</a>
    </p>
    <p>
        <a href="#G" target="_self">¿Qué es el resumen del Plan de acción?</a>
    </p>
    <p>
        <a href="#H" target="_self">¿Cuánto dura un concurso?</a>
    </p>
    <p>
        <a href="#K" target="_self">¿Cuántas contribuciones son necesarias para que un concurso sea válido?</a>
    </p>
    <p>
        <a href="#I" target="_self">¿Se puede rechazar una contribución?</a>
    </p>
    <p>
        <a href="#J" target="_self">¿Cuándo se declara nulo un concurso?</a>
    </p>
</nav>
<div class="clear"></div>

<section class="border-box-n">
    <a name="A" id="A"></a>
    <h2 class="faq">¿Qué es un concurso? </h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
                <ul style="margin-top: 0px;">
                <li>
                    Un concurso consiste en un procedimiento mediante el cual, un grupo virtual de consumidores (<?php echo link_to("colaboradores", "nosotros/glosarioterminos#Colaborador", array('class' => 'glosario', 'title' => 'Colaborador')); ?>), exponen públicamente una <?php echo link_to("incidencia", "nosotros/glosarioterminos#Incidencia", array('class' => 'glosario', 'title' => 'Incidencia')); ?> que han tenido como usuarios de una empresa, entidad pública o producto, que les ha producido una <?php echo link_to('experiencia de cliente insatisfactoria', 'preguntasfrecuentes/contribuir#B', array('title' => '¿Qué es una experiencia de cliente insatisfactoria?')) ?>, al no ajustarse a sus necesidades o expectativas.
                </li>
                <li>
                    Los colaboradores presentan una propuesta de mejora o <?php echo link_to("Plan de acción", "nosotros/glosarioterminos#Plan_de_accion", array('class' => 'glosario', 'title' => 'Plan de acción')); ?>, que sugiere recomendaciones sobre cómo mejorar la empresa, entidad o producto en concurso, a cambio de una recompensa en puntos canjeables por regalos.
                </li>
                <li>
                    La propuesta es votada en un <?php echo link_to('Referéndum', 'preguntasfrecuentes/participarReferendums#C', array('title' => '¿Cómo funciona un Referéndum en un concurso?')) ?> y se eligen las contribuciones que aportan más valor para la empresa, entidad pública o producto.
                </li>
                <li>
                    Las mejores propuestas forman parte de un Plan de acción final, que proponemos en venta a la empresa, entidad o fabricante del producto en concurso.
                </li>
                <li>
                    Si vendemos el Plan de acción como parte de una de nuestras <?php echo link_to('modalidades de servicio', 'nosotros/nuestros', array('title' => 'Nuestros servicios')) ?>, repartimos, además, parte del beneficio económico obtenido (<?php echo link_to("Participación en beneficio", "nosotros/glosarioterminos#Participacion_en_beneficio", array('class' => 'glosario', 'title' => 'Participación en beneficio')); ?>) entre aquellos colaboradores que han <?php echo link_to('contribuido', 'preguntasfrecuentes/recompensas#D', array('title' => '¿Quién tiene derecho a la Participación en beneficio?')) ?>.
                </li>
                <li>
                    Participar en un concurso se denomina <?php echo link_to("contribuir", "nosotros/glosarioterminos#Contribuir", array('class' => 'glosario', 'title' => 'Contribuir')); ?> y aportar un testimonio sobre una incidencia junto con una propuesta de mejora, <?php echo link_to("contribución", "nosotros/glosarioterminos#Contribucion", array('class' => 'glosario', 'title' => 'Contribución')); ?>.
                </li>
                <li>
                    Un concurso se desarrolla a lo largo de <?php echo link_to("estados", "nosotros_lightboxes/fasesconcurso", array('class' => 'lightbox-i-contenido', 'title' => 'Estados de un concurso')); ?> o fases y tiene una duración de 90 días naturales.
                </li>
                <li>
                    Un concurso es un medio para ofrecer ideas de mejora y soluciones en relación a una empresa, entidad pública, producto o servicio. No es un foro de protestas y quejas o un lugar donde despotricar gratuitamente contra empresas o instituciones.
                </li>
            </ul>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>


<section class="border-box-n">
    <a name="B" id="B"></a>
    <h2 class="faq">¿Cómo funciona un concurso?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <?php echo image_tag("img_nosotros/infograf/como_funciona_un_concurso.png", array('class' => 'diagrama')) ?>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="C" id="C"></a>
    <h2 class="faq">¿Qué hace falta para crear un concurso?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
           <p>
            Para crear un concurso, sólo necesitas haber tenido una <?php echo link_to("experiencia de cliente insatisfactoria", 'preguntasfrecuentes/contribuir#B', array('title' => '¿Qué es una experiencia de cliente insatisfactoria?')) ?> como usuario de un producto o servicio, hacer una <strong>propuesta</strong> de cómo mejorarlo y tener <strong>ganas de ganar dinero</strong>.
           </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="D" id="D"></a>
    <h2 class="faq">¿Cómo puedo crear un concurso?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Crear un concurso es muy fácil:
            </p>
            <ul>
                <li>
                    Haz clic en el botón <strong>crea concurso</strong> que puedes encontrar en la sección Concursos.
                </li>
                <li>
                    Rellena el formulario con los datos requeridos.
                </li>
                <li>
                    Haz clic en <strong>publica.</strong>
                </li>
            </ul>
            <p>
                Recuerda que, para crear un concurso, necesitas antes ser <?php echo link_to("colaborador", "nosotros/glosarioterminos#Colaborador", array('class' => 'glosario', 'title' => 'Colaborador')) ?>.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>
<section class="border-box-n">
    <a name="E" id="E"></a>
    <h2 class="faq">¿Cómo puedo contribuir en un concurso?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Contribuir en un concurso es muy fácil:
            </p>
            <ul>
                <li>
                    Entra en el concurso de tu interés y haz clic en <strong>contribuye.</strong>
                </li>
                <li>
                    Rellena el formulario con los datos requeridos.
                </li>
                <li>
                    Haz clic en <strong>publica.</strong>
                </li>
            </ul>
            <p>
                Recuerda que, para contribuir en un concurso, necesitas antes ser <?php echo link_to("colaborador", "nosotros/glosarioterminos#Colaborador", array('class' => 'glosario', 'title' => 'Colaborador')) ?>.
            </p>

        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="F" id="F"></a>
    <h2 class="faq">¿Por qué hay una parte pública y una parte privada?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Los concursos en los que contribuyes se componen, de una <strong>parte pública</strong> y una <strong>parte privada:</strong>
            </p>

            <ul>
                <li>
                    La <strong>parte pública</strong> muestra información que identifica el concurso (título, categoría, nombre de la empresa, entidad o producto, localidad, creador, etc.) e incluye la descripción de tu <?php echo link_to("incidencia", "nosotros/glosarioterminos#Incidencia", array('class' => 'glosario', 'title' => 'Incidencia')); ?> y el <?php echo link_to("resumen del Plan de acción", "nosotros/glosarioterminos#Resumen_del_Plan_de_accion", array('class' => 'glosario', 'title' => 'Resumen del Plan de acción')); ?>. 
                    <br><span style="display: block; width: 100%; height: 8px;"></span>
                    Esta parte es <strong>visible para cualquier usuario de nuestra web</strong>, aunque no sea colaborador de nuestra comunidad.
                </li>
                <li>
                    La <strong>parte privada</strong> está compuesta por tu <?php echo link_to("Plan de acción", "nosotros/glosarioterminos#Plan_de_accion", array('class' => 'glosario', 'title' => 'Plan de acción')); ?>, donde desarrollas en detalle tus propuestas de mejora y es, por tanto, la que tiene más valor.
                    <br>
                    Esta parte es <strong>visible sólo para ti y para</strong> <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>. Nadie más tiene acceso a esa información.
                    <br><span style="display: block; width: 100%; height: 8px;"></span>
                    Contiene las ideas con las que, posteriormente, <strong>elaboramos el Plan de acción final que vendemos</strong> a la empresa, entidad pública o fabricante del producto en concurso.
                    <br><span style="display: block; width: 100%; height: 8px;"></span>
                    De aquí <strong>obtenemos el beneficio</strong> que, si tu Plan de acción resulta elegido entre los mejores, <?php echo link_to('compartimos contigo', 'preguntasfrecuentes/recompensas#B', array('title' => '¿Qué porcentaje de beneficio repartimos?')) ?> y los demás colaboradores que también han contribuido con propuestas de valor.
                </li>
            </ul>
            <span style="display: block; width: 100%; height: 8px;"></span>
            <p>
                Tener una <strong>parte privada te garantiza</strong> lo siguiente:
            </p>
            <ul>
                <li>
                    Que se respetan los <strong>derechos de autor y propiedad intelectual</strong> de tu proyecto.
                </li>
                <li>
                    Que <strong>ningún otro colaborador pueda copiar o modificar tu trabajo</strong> y sacar de él un beneficio individual sin tu consentimiento.
                </li>
                <li>
                    Que, en el caso de que vendamos el Plan de acción, <strong>tú seas el principal beneficiario</strong> de tu esfuerzo.
                </li>
                <li>
                    Que cada colaborador contribuye con <strong>ideas originales</strong>.
                </li>
            </ul>
            <p>
                Para saber más sobre cómo escribir un buen Plan de acción revisa nuestros <?php echo link_to("consejos para redactar un Plan de acción", "nosotros/consejos", array('title' => 'Consejos para redactar un Plan de acción')) ?>.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="G" id="G"></a>
    <h2 class="faq">¿Qué es el resumen del Plan de acción?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Tu Plan de acción consta de una parte pública o <?php echo link_to("resumen del Plan de acción", "nosotros/glosarioterminos#Resumen_del_Plan_de_accion", array('class' => 'glosario', 'title'=>'Resumen del Plan de acción')) ?>, visible para el resto de los colaboradores, y que tiene los siguientes objetivos:
            </p>
            <ul>
                <li>
                    <strong>Mostrar los aspectos más relevantes</strong> y atractivos de tu propuesta, para que los demás colaboradores puedan valorarla y te puedan <?php echo link_to("votar", 'preguntasfrecuentes/participarReferendums#C', array('title' => '¿Cómo funciona un Referéndum en un concurso?')) ?>.
                </li>
                <li>
                    <strong>Servir como referencia y estímulo</strong> a las contribuciones de los demás colaboradores.
                </li>
                <li>
                    <strong>Despertar el interés</strong> de las posibles entidades compradoras.
                </li>
                <li>
                    Para saber más sobre cómo escribir un buen resumen del Plan de acción, visita <?php echo link_to("Consejos resumen del Plan de acción", "nosotros/consejos?page=6", array('title'=>'Consejos resumen del Plan de acción')) ?>.
                </li>
            </ul>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>
<section class="border-box-n">
    <a name="H" id="H"></a>
    <h2 class="faq">¿Cuánto dura un concurso?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Un concurso está activo durante <strong>90 días</strong> (alrededor de 3 meses) desde su creación, <strong>único momento en el que puedes contribuir</strong> en el mismo.
            </p>
            <p>
                A este periodo, se le suma el tiempo necesario para elegir las mejores contribuciones y proclamar a los ganadores (<?php echo link_to("Referendúm", "nosotros/glosarioterminos#Referendum", array('class' => 'glosario', 'title'=>'Referéndum')) ?>, 7 días), así como decidir las siguientes acciones a tomar (<?php echo link_to('Deliberación','nosotros/glosarioterminos#Deliberacion',array('title'=>'Deliberación','class'=>'glosario'))?>, tiempo indefinido).
            </p>
            <p>
                Todos los concursos tienen la misma duración, que no puede ser acortada ni prorrogada y se desarrollan a lo largo de los mismos estados.
            </p>
            <p>
                Ocasionalmente, un concurso puede ser detenido temporalmente por motivos de mantenimiento (<?php echo link_to("Revisión", "nosotros/glosarioterminos#Revision", array('class' => 'glosario', 'title' => 'Revisión')) ?>).
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>

<section class="border-box-n">
    <a name="K" id="K"></a>
    <h2 class="faq">¿Cuántas contribuciones son necesarias para que un concurso sea válido?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Un concurso es válido cuando ha generado, por lo menos, la <strong>cantidad mínima requerida de contribuciones de valor y votos de colaboradores</strong> en relación a una incidencia. En caso contrario es declarado <a href="#J" title="¿Cuándo se declara nulo un concurso?">nulo</a>.
            </p>
            <p>
                La cantidad de contribuciones de valor y votos mínimos requeridos para que el concurso sea válido, depende del <strong>número estimado de clientes al año</strong> que reciben los servicios o adquieren los productos de la empresa o entidad en concurso.
            </p>
            <p>
                Igualmente, depende del <strong>número estimado de compradores o usuarios al año</strong> del producto en concurso.
            </p>
            <ul>
                <li>
                    Cuando es un <strong>pequeño negocio, entidad pequeña o producto de uso poco frecuente</strong> (menos de 2.500 clientes o usuarios al año), un concurso es válido:
                    <ul>
                        <li>
                            Si tiene publicadas <strong>25 contribuciones o más</strong> de valor.
                        </li>
                        <li>
                            Si el Referéndum cuenta con la <strong>participación del 25% o más</strong> de los colaboradores participantes en el concurso, con un mínimo de 10 <?php echo link_to('electores','nosotros/glosarioterminos#Elector',array('class'=>'glosario','title'=>'Elector'))?> y 25 votos emitidos.
                        </li>
                    </ul>
                    Ejemplos de esta categoría pueden ser: una clínica dental; una peluquería; un modelo de sofá; un comercio de ropa de barrio; un instrumento científico; una autoescuela; una asesoría fiscal; una empresa de reformas, etc.
                </li>
                <li style="margin-top: 1.8em;">
                    Cuando es una <strong>mediana empresa, entidad mediana o un producto de uso moderadamente frecuente</strong> (entre 2.500 y 10.000 clientes o usuarios al año), un concurso es válido:
                    <ul>
                        <li>
                            Si tiene publicadas <strong>100 contribuciones</strong> o más de valor.
                        </li>
                        <li>
                            Si el Referéndum cuenta con la <strong>participación del 25% o más</strong> de los colaboradores participantes en el concurso.
                        </li>
                    </ul>
                    Ejemplos de esta categoría pueden ser: un restaurante; un ambulatorio local; un modelo de moto; un ayuntamiento de un pueblo; una heladería; unos palos de golf; una pastelería; un teatro, etc.
                </li>
                <li style="margin-top: 1.8em;">
                    Cuando es una <strong>gran empresa, entidad grande o un producto de uso frecuente</strong> (más de 10.000 clientes o usuarios al año), un concurso es válido:
                    <ul>
                        <li>
                            Si tiene publicadas <strong>250 contribuciones</strong> o más de valor.
                        </li>
                        <li>
                            Si el Referéndum cuenta con la <strong>participación del 25% o más</strong> de los colaboradores participantes en el concurso.
                        </li>
                    </ul>
                    Ejemplos de esta categoría pueden ser: un banco; una compañía de transportes; un ayuntamiento de una capital; una cadena de ropa; un ministerio; una empresa de seguros; unos grandes almacenes; una operadora de telefonía, etc.
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
    <h2 class="faq">¿Se puede rechazar una contribución?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
            <p>
                Una contribución en un concurso puede ser <strong>rechazada y no publicada</strong> por los siguientes motivos:
            </p>
            <ul>
                <li>
                    <strong>No cumplir</strong> con alguna de las condiciones establecidas en nuestras <strong>condiciones de participación</strong>.
                </li>
                <li>
                    <strong>Infringir</strong> alguna de las condiciones dispuestas en nuestros <strong>términos legales</strong>.
                </li>
                <li>
                    <strong>No aportar interés y valor</strong> para el concurso.
                </li>
            </ul>
            <p>
                Cuando una contribución es rechazada, informamos al colaborador interesado de los motivos, así como acciones a realizar y la contribución queda <strong>guardada en su</strong> <?php echo link_to('borrador', 'preguntasfrecuentes/funcionamiento#B', array('title' => '¿Qué es el borrador?')) ?>.
            </p>
            <p>
                Una contribución rechazada puede volver a ser publicada, en el momento en que se solucionan los problemas detectados.
            </p>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>


<section class="border-box-n">
    <a name="J" id="J"></a>
    <h2 class="faq">¿Cuándo se declara nulo un concurso?</h2>
    <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
        <div class="top-right">
                <ul style="margin-top: 0px;">
                <li>
                    Un concurso es declarado <?php echo link_to("nulo", "nosotros/glosarioterminos#Nulo", array('class' => 'glosario', 'title'=>'Nulo')) ?> si no ha generado la <a href="#K" title="¿Cuántas contribuciones son necesarias para que un concurso sea válido?">cantidad mínima requerida</a> <strong>de contribuciones de valor y votos</strong> de colaboradores en relación a una incidencia.
                </li>
                <li>
                    Declaramos "nulo" un concurso cuando finaliza su estado "activo" y no alcanza el número de contribuciones necesarias para <strong>ofrecer datos representativos.</strong>
                </li>
                <li>
                    Igualmente, declaramos "nulo" un concurso cuando ha alcanzado el número de contribuciones necesarias para ofrecer datos representativos, pero su Referéndum no cuenta con una cantidad mínima de votos para <strong>confirmar el valor de las propuestas</strong> realizadas.
                </li>
                <li>
                    Un concurso "nulo" pasa a estado <strong>"cerrado"</strong> y no se puede volver a reactivar. 
                </li>
                <li>
                    Una empresa, entidad pública o producto auditado en un concurso declarado "nulo" <strong>puede volver a ser objeto de nuevo concurso</strong> en el momento en que el mismo colaborador u otro desee comunicar una incidencia, que puede ser de la misma naturaleza.
                </li>
                <li>
                    Finalmente, los colaboradores participantes en un concurso "nulo" <strong>no pierden los puntos que han ganado.</strong>
                </li>
            </ul>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</section>
