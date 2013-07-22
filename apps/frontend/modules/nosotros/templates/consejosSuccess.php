<div id="content_breadcroum">
    <?php echo link_to("Inicio", "home/index") ?> >> 
</div>
<div id="content_nosotros_consejos">
    <?php if ($page == 1): ?>
        <div id="parrafo"> 
            <h2>Consejos para la redacción de un Plan de acción</h2> 
            <div id="forma_hea"></div>
            <div id="forma_body">
                <div id="alinea">
                    Tu Plan de acción es la parte más importante y que aporta más valor dentro de tu incidencia.<br/>


                    Algunos consejos para la redacción de un buen Plan de acción:<br/>
                    <ul><li>

                            Hazte y responde a las siguientes preguntas:
                        </li><ul><li>
                                ¿Qué se puede mejorar?
                            </li><li>¿Cómo se puede mejorar?
                            </li><li>¿En cuánto tiempo?
                            </li><li>¿Qué recursos son necesarios?
                            </li><li>¿Qué valor aportarían las mejoras a la empresa, entidad o producto?
                            </li><li>¿Qué valor te aportarían a ti y a otros usuarios?
                            </li><li>¿Conoces otros casos en los que los aspectos que quieres mejorar son como tú deseas?
                            </li></ul>
                        <li>
                            Tus propuestas necesitan ser <strong>específicas y relacionadas con la incidencia</strong> que quieres comunicar, aunque puedes utilizar medidas que hayan funcionado en otros casos similares que conozcas.
                        </li><li>
                            Tu Plan de acción puede ser tan extenso, complejo y detallado como desees (cuantos más detalles incluyas, más valor tiene) y puedes incluir documentación de apoyo, como fotos, imágenes o video.
                        </li><li>
                            Propón <strong>ideas innovadoras y valientes pero a la vez realistas</strong>, que tengan en cuenta el mercado y la capacidad de la empresa o entidad para ponerlas en práctica.
                        </li></ul>
                </div></div> 
            <div id="forma_bot"></div>
        </div>

    <?php elseif ($page == 2): ?>

        <div id="parrafo"> 
            <h2>Consejos para describir una incidencia</h2> 
            <div id="forma_hea"></div>
            <div id="forma_body">
                <div id="alinea">
                    <ul><li>Por favor, introduce una descripción lo más clara, precisa y detallada posible sobre la incidencia que quieres comunicar.
                        </li><li>
                            Algunos consejos para describir una incidencia:
                        </li><li>
                            Valora adecuadamente la incidencia que quieres comunicar. No se trata únicamente de informar sobre una empresa, entidad pública, producto o servicio que no funciona bien sino también de dar a conocer aquéllos que no se ajustan a tus necesidades y expectativas.
                        </li><li>
                            Incluye todos los detalles que consideres relevantes. Dispones de un espacio equivalente de 3 folios estándar.
                        </li><li>
                            Si quieres añadir información adicional, puedes adjuntar ficheros de apoyo en forma de texto, audio, foto o video. ¡Aprovéchalo!
                        </li><li>
                            No pierdas demasiado tiempo en introducciones o formalismos. Ve directo al asunto y toma estas pautas como referencia:
                        </li><ul><li>
                                ¿Qué ha ocurrido?
                            </li><li>¿Dónde ha ocurrido?
                            </li><li>¿Cuándo ha ocurrido?
                            </li><li>¿Cómo ha ocurrido?
                            </li><li>¿Cómo te sentiste al respecto?</li></ul>
                        <li></li>
                        No te preocupes demasiado por el estilo o la ortografía. Lo importante es lo que quieres contar. Nadie te va a juzgar.
                    </li><li>
                    Céntrate en los hechos y en tus sentimientos. Evita comentarios que puedan resultar ofensivos o hieran la sensibilidad de las personas.
                </li></ul>

        </div></div> 
    <div id="forma_bot"></div>
    </div>
<?php elseif ($page == 3): ?>
    <div id="parrafo"> 
        <h2>Consejos para contribuir en un concurso</h2> 
        <div id="forma_hea"></div>
        <div id="forma_body">
            <div id="alinea"><ul><li>
                        <strong>Lee atentamente las contribuciones<strong> de los otros colaboradores antes de publicar la tuya.
                            </li><li>
                            Ponte en el lugar de la empresa o entidad en concurso y <strong>piensa cómo le puedes ayudar</strong>.
                        </li><li>
                            No pierdas de vista nuestras <span class="link_rojo"><?php echo link_to("condiciones de participación", "nosotros/condicionesparticipacion") ?></span>.
                        </li><li>
                            Introduce un <strong>título descriptivo</strong> y que llame la atención.
                        </li><li>
                            Realiza una <strong>descripción de la incidencia suficiente y detallada</strong>.
                        </li><li>
                            Tómate tu tiempo para <strong>proponer un Plan de acción original y factible</strong> que aporte valor.
                        </li><li>
                            No te olvides de <strong>participar en el</strong> <span class="link_rojo"><?php echo link_to("Referéndum", "nosotros/concurso?page=5") ?></span>
                        </li><li>
                            Sé activo. Involúcrate hasta el final y <strong>audita el resultado</strong> de tu propuesta.
                        </li></ul>
                        </div></div> 
                        <div id="forma_bot"></div>
                        </div>
                    <?php elseif ($page == 4): ?>
                        <div id="parrafo"> 
                            <h2>Consejos para adjuntar documentación de apoyo</h2> 
                            <div id="forma_hea"></div>
                            <div id="forma_body">
                                <div id="alinea">
                                    Si no te ha alcanzado el espacio dispuesto para describir la incidencia o redactar tu Plan de acción o <strong>deseas incluir información adicional complementaria</strong>, no te preocupes. <br/>
                                    Puedes adjuntar la documentación de apoyo que creas conveniente, hasta un máximo de 5 ficheros y 2 GB por contribución, en los siguientes formatos:<br/>
                                    <ul><li>
                                            Texto (DOC, PPT, PDF)
                                        </li><li>
                                            Audio (WAV, MIDI,  MP3)</li><li>
                                            Imagen (JPEG, GIF, TIFF, EPS)</li><li>
                                            Video  (MOV, AVI, MPEG).</li></ul>



                                    Para ello sólo tienes que hacer clic en añadir fichero y seguir las instrucciones.

                                </div></div> 
                            <div id="forma_bot"></div>
                        </div>
                    <?php elseif ($page == 5): ?>
                        <div id="parrafo"> 
                            <h2>Consejos para auditar una empresa, entidad o producto</h2> 
                            <div id="forma_hea"></div>
                            <div id="forma_body">
                                <div id="alinea">
                                    Para auditar correctamente y que tu opinión aporte valor, ten en cuenta los siguientes consejos:<br/>
                                    <ul><li>
                                            Antes de auditar una empresa, entidad o producto, es importante que <strong>seas usuario del mismo</strong> y lo conozcas de primera mano.
                                        </li><li>
                                            <strong>Si no conoces la empresa, entidad o producto, no audites</strong> y reserva tu experiencia para otra ocasión.
                                        </li><li>
                                            Sé <strong>objetivo e imparcial</strong> y ten en cuenta que buscamos excelencia, no perfección.
                                        </li><li>
                                            Piensa que los resultados de tu auditoría pueden determinar el futuro de la empresa o entidad pública, así como el de sus trabajadores. Si vas a ser crítico y crees que hay cosas que mejorar, <strong>sé constructivo y propón mejoras</strong>.
                                        </li><li>
                                            <strong>Puedes auditar hasta 1 vez al mes</strong> a la misma empresa, entidad o producto que deseas valorar, con un intervalo mínimo entre cada valoración de 30 días.
                                        </li></ul>
                                </div></div> 
                            <div id="forma_bot"></div>
                        </div>    
                    <?php elseif ($page == 6): ?>
                        <div id="parrafo"> 
                            <h2>Consejos resumen del Plan de acción</h2> 
                            <div id="forma_hea"></div>
                            <div id="forma_body">
                                <div id="alinea">

                                    <ul><li>
                                            El resumen del Plan de acción consiste en un sumario del mismo en 10 líneas.
                                        </li><li>
                                            Ten en cuenta que es la única parte del Plan de acción que es visible públicamente.
                                        </li><li>
                                            Algunos consejos para la redacción del resumen del Plan de acción:
                                        </li><li>

                                            Sé original y creativo. Considera el resumen como la ocasión de vender tu idea al resto de colaboradores. 
                                        </li><li>
                                            Trata de resumir brevemente las acciones de mejora que propones.
                                        </li><li>
                                            No te pierdas en detalles. Menciona de manera general los puntos más relevantes que ya han sido desarrollados extensamente.
                                        </li><li>
                                            Usa frases cortas y sencillas. Si vas a mencionar varias medidas sepáralas por comas o puntos.
                                        </li><li>
                                            Intenta resaltar las acciones recomendadas que aportan más valor, son más novedosas u originales.
                                        </li></ul>
                                </div></div> 
                            <div id="forma_bot"></div>
                        </div>
                    <?php elseif ($page == 7): ?>
                        <div id="parrafo"> 
                            <h2>¿Por qué hay una parte pública y una parte privada?</h2> 
                            <div id="forma_hea"></div>
                            <div id="forma_body">
                                <div id="alinea">
                                    Los concursos en los que contribuyes se componen de una <strong>parte pública</strong> y una <strong>parte privada</strong>:
                                    <ul><li>
                                            La <strong>parte pública</strong> muestra información que identifica el concurso (categoría, título, empresa o producto, dirección, localidad, creador, etc.) e incluye la descripción de tu <span class="azulon">incidencia</span> y el <span class="azulon">resumen del Plan de acción</span>.
                                        </li><li>
                                            Esta parte es <strong>visible para cualquier usuario de nuestra web</strong>, aunque no sea colaborador de nuestra comunidad.
                                        </li><li>
                                            Aquí describes en detalle los hechos de tu incidencia, para que otros <span class="azulon"><?php echo link_to("colaboradores", "nosotros/glosarioterminos#C") ?></span> la conozcan y puedan contribuir con sus propias incidencias relacionadas con la misma empresa, entidad o producto, junto con sus propuestas de mejora.
                                        </li><li>
                                            La <strong>parte privada</strong> está compuesta por tu <span class="azulon"><?php echo link_to("Plan de acción", "nosotros/glosarioterminos#P") ?></span>, donde desarrollas en detalle tus propuestas de mejora y es, por tanto, la que tiene más valor.
                                        </li><li>
                                            Esta parte es  <strong>visible sólo para ti y para</strong> <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span>. Nadie más tiene acceso a esa información.
                                        </li><li>
                                            Contiene las ideas con las que posteriormente elaboramos el Plan de acción final que vendemos a la empresa, entidad o fabricante del producto en concurso.
                                        </li><li>
                                            De aquí obtenemos el beneficio que, si tu Plan de acción resulta elegido entre los mejores,<span class="link_rojo"><?php echo link_to("compartimos contigo", "nosotros/condicionescaja") ?></span> y los demás colaboradores que también han contribuido con propuestas de valor.
                                        </li></ul>


                                    Tener una parte privada te garantiza lo siguiente:<br/>
                                    <ul><li>
                                            Que se respetan los <strong>derechos de autor y propiedad intelectual</strong> de tu proyecto.
                                        </li><li>
                                            Que <strong>ningún otro colaborador pueda copiar o modificar</strong> tu trabajo y sacar de él un beneficio individual sin tu consentimiento.
                                        </li><li>
                                            Que en el caso de que vendamos el Plan de acción <strong>tú seas el principal beneficiario</strong> de tu esfuerzo.
                                        </li><li>
                                            Que cada colaborador contribuye con <strong>ideas originales</strong>.
                                        </li><li>
                                            Para saber más sobre cómo escribir un buen Plan de acción visita <span class="link_rojo">Consejos para redactar un Plan de acción</span>.
                                        </li></ul>
                                </div></div> 
                            <div id="forma_bot"></div>
                        </div>
                    <?php elseif ($page == 8): ?>
                        <div id="parrafo"> 
                            <h2>Consejos para recomendar a un profesional</h2> 
                            <div id="forma_hea"></div>
                            <div id="forma_body">
                                <div id="alinea">
                                    Cuando recomiendas a un profesional, haces una <strong>valoración positiva</strong> del servicio que te ha prestado.<br/>

                                    Al recomendar a un profesional, ten en cuenta lo siguiente:<br/>
                                    <ul><li>
                                            <strong>No lo estás valorando personalmente</strong>, si te cae bien o mal, sino como profesional que te presta un servicio. 
                                        </li><li>
                                            Comienza explicando <strong>qué tipo de trato profesional has tenido</strong> con él/ella y cómo te has sentido.
                                        </li><li>
                                            Enumera cuáles son los <strong>puntos concretos que le hacen ser un buen profesional</strong>.
                                        </li><li>
                                            Pregúntate <strong>si tiene algo que mejorar</strong> y cómo lo harías para que su servicio fuese perfecto.
                                        </li><li>
                                            Seguro que has conocido a otros profesionales de la misma actividad antes que a éste. ¿Qué <strong>aspectos de su servicio son mejores, iguales o peores</strong> a los que te prestan otros?
                                        </li><li>
                                            Finalmente, piensa: ¿<strong>Lo recomendarías</strong> a tus amigos?
                                        </li></ul>                                  
                                </div></div> 
                            <div id="forma_bot"></div>
                        </div>
                    <?php elseif ($page == 9): ?>
                        <div id="parrafo"> 
                            <h2>Consejos para desaprobar a un profesional</h2> 
                            <div id="forma_hea"></div>
                            <div id="forma_body">
                                <div id="alinea">
                                    Cuando desapruebas a un profesional, haces una <strong>valoración negativa</strong> del servicio que te ha prestado.<br/>

                                    Al desaprobar a un profesional, ten en cuenta lo siguiente:<br/>
                                    <ul><li>
                                            <strong>No lo estás valorando personalmente</strong>, si te cae bien o mal, sino como profesional que te presta un servicio. 
                                        </li><li>
                                            Comienza explicando <strong>qué tipo de trato profesional has tenido</strong> con él/ella y cómo te has sentido.
                                        </li><li>
                                            Enumera cuáles son los <strong>puntos concretos que no te han gustado</strong> del servicio que te ha prestado.
                                        </li><li>
                                            Describe qué <strong>puntos necesita mejorar</strong> para convertirse en un buen profesional.
                                        </li><li>
                                            Seguro que has conocido a otros profesionales de la misma actividad antes que a éste: ¿Qué <strong>aspectos de su servicio son peores, iguales o mejores</strong> a los que te proporcionan otros?
                                        </li><li>
                                            Finalmente, piensa: ¿<strong>Lo recomendarías</strong> a tus amigos?
                                        </li></ul>
                                </div></div> 
                            <div id="forma_bot"></div>
                        </div>
                    <?php elseif ($page == 10): ?>
                        <div id="parrafo"> 
                            <h2></h2> 
                            <div id="forma_hea"></div>
                            <div id="forma_body">
                                <div id="alinea">

                                </div></div> 
                            <div id="forma_bot"></div>
                        </div>
                    <?php elseif ($page == 11): ?>
                        <div id="parrafo"> 
                            <h2></h2> 
                            <div id="forma_hea"></div>
                            <div id="forma_body">
                                <div id="alinea">

                                </div></div> 
                            <div id="forma_bot"></div>
                        </div>
                    <?php elseif ($page == 12): ?>
                        <div id="parrafo"> 
                            <h2></h2> 
                            <div id="forma_hea"></div>
                            <div id="forma_body">
                                <div id="alinea">

                                </div></div> 
                            <div id="forma_bot"></div>
                        </div>
                    <?php endif; ?>

                    </div>
