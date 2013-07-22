<?php use_helper('Date', 'Text') ?>
<div id="concurso_destacados">
    <div align="left"><span class="concurso_titulo_destacado">Comunidades Destacadas</span>
    </div>
    <?php echo image_tag("img/linea_concursos_destacados.png") ?>


    <?php foreach ($concursosdestacados as $destacado): ?>
        <div id="enumera_concurso_destacado">
            <div id="concurso_titulo"> <?php echo $destacado->name ?><br></div>
            <div id="concurso_categoria"><?php echo $destacado->ConcursoCategoria->name ?></div>
            <div id="concurso_inci"><?php echo "Resumen: " . truncate_text($destacado->incidencia, $length = 60) ?>
            </div>
            <!--     <div id="concurso_provincia"><?php //echo $destacado->States->name  ?></div>-->

            
            <div id="ver_concurso">
                <span class="texto_concurso">
                    <a href="#"> comentarios</a>  
                </span>

            </div>

        </div>
        <hr>
    <?php endforeach; ?>
</div>