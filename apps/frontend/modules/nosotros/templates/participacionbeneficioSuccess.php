<?php echo include_partial('nosotros/miga', array('nombreSeccion' => 'Condiciones para la Participación en beneficio', 'tituloSeccion' => 'Condiciones para la Participación en beneficio')) ?>

<article id="content_nosotros_sistema">
    <a name="inicio"></a>
    <h1>Condiciones para la Participación en beneficio</h1>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        La Participación en beneficio consiste en una <strong>recompensa en forma de dinero,</strong> que no se puede canjear por su equivalente en regalos.
                    </li>
                    <li>
                        Participas en beneficio si alguna de tus contribuciones ha resultado clasificada entre las <strong>3 más votadas,</strong> en el concurso en el que contribuyes.
                    </li>
                    <li>
                        También participas en beneficio si alguna de tus contribuciones ha sido <strong>votada por 5 colaboradores o más,</strong> consiguiendo un mínimo de 10 puntos.
                    </li>
                    <li>
                        Puedes <strong>participar en beneficio más de una vez</strong> en un concurso, si tienes <strong>más de una contribución</strong> clasificada entre las 3 más votadas, o cada contribución ha recibido votos de 5 colaboradores o más, consiguiendo un mínimo de 10 puntos. Cada contribución debe ser claramente diferente y con Planes de acción diferentes también.
                    </li>
                    <li>
                        Recibes tu Participación en beneficio en el momento en el que <strong>el cliente contratante abona la totalidad</strong> del valor del servicio. En caso de anulación del contrato o impago por su parte, no se realizará Participación en beneficio.
                    </li>
                    <li>
                        El dinero que ganas se trasfiere a tu <?php echo link_to("cuenta de colaborador", "nosotros/glosarioterminos#Cuenta_de_colaborador", array('class' => 'glosario', 'title' => 'Cuenta de colaborador')) ?></span>. Para hacerlo efectivo, ten en cuenta las <?php echo link_to("condiciones para hacer caja", "nosotros/condicionescaja", array('title' => 'Condiciones para hacer caja')) ?>.
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
$pie = '<div id="menu_footer_texto">' .
        link_to("Cómo cobrar tu caja", "nosotros/cobrarcaja", array('title' => 'Cómo cobrar tu caja')) . ' - ' .
        link_to("Condiciones para canjear tus regalos", "nosotros/canjeregalos", array('title' => 'Condiciones para canjear tus regalos')) . ' - ' .
        link_to("Concursos", "concurso/index", array('title' => 'Concursos')) . ' - ' .
        link_to("Qué es el Directorio", "nosotros/directorio", array('title' => 'Qué es el Directorio de buenos profesionales')) . '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">' . image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) . '</a>
   </div>';
slot('nosotros_footer', $pie);
?>     