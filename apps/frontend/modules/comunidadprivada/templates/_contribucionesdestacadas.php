<?php use_helper('Date', 'Text') ?>
<div id="contribuciones_destacadas">
    <div align="center"><span class="titulo_destacado">Contribuciones Destacadas</span></div>
    <?php echo image_tag("img/linea_concursos_destacados.png") ?>
    <?php foreach ($contribucionesdestacadascp as $contribuciones): ?>
        <div id="enumera_contribucion">
            <div align="center"> <?php echo $contribuciones->id//echo $contribuciones->name ?> </div>
            <!-- Tipo empresa -->
            <?php //if ($contribuciones->Concurso->concurso_tipo_id == 1): ?>
                <!--        <div align="left"> <?php //echo "Concurso: ".$contribuciones->Concurso->Empresa->id   ?></div>-->
                <!-- Producto -->
            <?php //elseif ($contribuciones->Concurso->concurso_tipo_id == 2): ?>
            <?php //endif; ?>
            <span class="resumen"><?php //echo "Resumen: " . truncate_text($contribuciones->resumen, $length = 150) ?>
            </span>
                
            <?php if ($contribuciones->ConcursoCp->ConcursoEstado->value == 2): ?>
                <?php //echo link_to("contribuir","concurso/show") ?>
                <div id="boton_contribuye">
                    <span class="texto_contribuye">
                        <a href="#">contribuye</a>  
                    </span>
                </div>
            <?php elseif ($contribuciones->ConcursoCp->ConcursoEstado->value == 3): ?>
                <div id="boton_vota">
                    <span class="texto_vota">
                        <a href="#">vota</a> 
                    </span>
                </div>
            <?php endif; ?> 
        </div>
    <?php endforeach; ?>
</div>