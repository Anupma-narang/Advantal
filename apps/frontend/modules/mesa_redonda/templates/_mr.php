<?php use_helper('Date') ?>

<div id="concurso_mesa">
    <div id="mrl"> <span class="mr_titulo"><?php echo $mesa_redonda->name ?> </span>
        <span class="mr_fecha"><?php echo format_datetime($mesa_redonda->created_at, "p", "es_ES") ?></span>
        <span class="mr_categoria"><?php echo $mesa_redonda->MesaredondaCategoria ?></span>
        <span class="mr_alias">Creado por Lali</span>
        <span class="mr_estado">Estado: <?php echo $mesa_redonda->MesaredondaEstado->name ?></span>  
        <span class="mr_ponencias"><?php echo count($mesa_redonda->MesaredondaPonencia) ?> ponencias</span> 
    </div> 
    <div id="mrr">
        <span class="mr_img">
            <?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . "/" . $mesa_redonda->MesaredondaCategoria->image) ?>
        </span>
    </div>
    <div id="mrb">
        <span class="mr_boton">
                <?php echo link_to("Ver mesa redonda", "mesa_redonda/show?id=" . $mesa_redonda->id) ?>
            </span>
    </div>

</div>
