<?php echo include_partial('nosotros/miga',array('nombreSeccion'=>'Nuestros proyectos y metodología','tituloSeccion'=>'Nuestros proyectos y metodología')) ?>

<article id="content_nosotros_listablanca">
    <a name="inicio"></a>
    <h1>Nuestros proyectos y metodología</h1>
    <h2>¿Qué incluyen nuestros proyectos? Análisis de Experiencia de cliente y auditoría continua </h2>
    <div class="pxh20"></div>
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <ul style="margin-top: 0px;">
                    <li>
                        Análisis del <?php echo link_to('Ecosistema de experiencia de cliente', 'nosotros/glosarioterminos#Ecosistema_de_experiencia_de_cliente', array('class'=>'glosario', 'title'=>'Ecosistema de experiencia de cliente'))?>. 
                    </li>
                    <li>
                        <strong>Métricas</strong> de experiencia de cliente: <?php echo link_to('Customer Experience Index', 'nosotros/glosarioterminos#Customer_Experience_Index', array('class'=>'glosario', 'title'=>'Customer Experience Index'))?>, <?php echo link_to('Brand Experience Index', 'nosotros/glosarioterminos#Brand_Experience_Index', array('class'=>'glosario', 'title'=>'Brand Experience Index'))?>, <?php echo link_to('Net Promoter Score', 'nosotros/glosarioterminos#Net_Promoter_Score', array('class'=>'glosario', 'title'=>'Net Promoter Score'))?>.
                    </li>
                    <li>
                        Realización de <?php echo link_to('Matriz de Posicionamiento', 'nosotros/glosarioterminos#Matriz_de_Posicionamiento', array('class'=>'glosario','title'=>'Matriz de Posicionamiento'))?> <strong>frente a la competencia.</strong>
                    </li>
                    <li>
                        Identificación de <?php echo link_to('drivers de satisfacción', 'nosotros/glosarioterminos#Drivers_de_satisfaccion', array('class'=>'glosario','title'=>'Drivers de satisfacción'))?>.
                    </li>
                    <li>
                        Identificación de <?php echo link_to('B2C KPIs', 'nosotros/glosarioterminos#B2C_KPIs', array('class'=>'glosario', 'title'=>'B2C KPIs'))?>.
                    </li>
                    <li>
                        Identificación de <strong>aspectos críticos de mejora.</strong>
                    </li>
                    <li>
                        <strong>Reingeniería</strong> de Procesos.
                    </li>
                    <li>
                        Realización del <?php echo link_to('Mapa de la experiencia', 'nosotros/glosarioterminos#Mapa_de_la_experiencia', array('class'=>'glosario','title'=>'Mapa de la experiencia'))?>.
                    </li>
                    <li>
                        <strong>Auditoría continua</strong> de experiencia de cliente.
                    </li>
                </ul>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </section>
    
    <h2>¿Cuál es nuestra metodología? Investigación holística </h2>    
    <section class="border-box-n">
        <div class="header-left">             <div class="header-right"></div>         </div><div class="top-left">
            <div class="top-right">
                <p>
                    Nuestra metodología de extracción y análisis de datos <strong>combina técnicas cualitativas y cuantitativas</strong> de disciplinas como la sociología, la psicología, la etnografía y el neuromarketing.
                </p>
                <p>
                    Esta <strong>aproximación holística</strong> establece un análisis profundo de las motivaciones, percepciones y sentimientos de los usuarios estudiados hacia tus productos y servicios, creando modelos cuantificables y extrapolables al resto de tus clientes.
                </p>
                <p>
                    Estas son algunas de las técnicas que empleamos:
                </p>
                <ul>
                    <li>
                        Grupos virtuales de discusión <strong>(Focus Groups)</strong>.
                    </li>
                    <li>
                        <strong>Observación participante</strong> (Mystery Shopping) in situ.
                    </li>
                    <li>
                        <strong>Entrevistas personales</strong> en profundidad.
                    </li>
                    <li>
                        <strong>Cuestionarios</strong> on-line.
                    </li>
                    <li>
                        <strong>Encuestas</strong> telefónicas.
                    </li>
                    <li>
                        <strong>Asociación Libre</strong> de ideas.
                    </li>
                    <li>
                        <strong>Análisis de contenido.</strong>
                    </li>
                    <li>
                        <strong>Panel Delphi.</strong>
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
       link_to("Precios por modalidad de servicio","nosotros/preciospormodalidad", array('title'=>'Precios por modalidad de servicio')).' - '.
       link_to("Contrátanos","nosotros/empresa", array('title'=>'Contrátanos')).' - '.
       link_to("Concursos", "concurso/index", array('title' => 'Concursos')) .' - '.
       link_to("Qué es el Directorio","nosotros/directorio", array('title'=>'Qué es el Directorio de buenos profesionales')). '
        </div>
   <div id="menu_footer_boton">
       <a href="#inicio">'.image_tag("img/img_flecha_menu_footer.png", array('title'=>'Ir arriba')).'</a>
   </div>';
slot('nosotros_footer', $pie);
?>
