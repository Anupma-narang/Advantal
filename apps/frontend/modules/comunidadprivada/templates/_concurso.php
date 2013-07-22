<?php use_helper('Date','Text') ?>
<div id="content_concurso_activo">
        <div id="title_concurso">Concurso de Ideas para mejorar <span class="azulon"><?php echo $concursocp->name ?></span></div>
       <div id="box_left">

        <div id="fecha"><?php echo format_datetime($concursocp->created_at, "p", "es_ES") ?></div>
        <div id="categoria_concurso"><?php echo $concursocp->ConcursoCategoria->name ?></div>
<!--        <div id="categoria_tipo"><?php //echo $concurso->ConcursoTipo->name   ?></div>-->
        <div id="direccion">Calle la que sea, 45</div>
        <div id="localidad">Albacete</div>
    </div>
    <div id="box_cen">
        <div id="box_cen_uno"></div>
        <div id="box_cen_dos">
<!--            Falta la relacion la tabla empresa-->
            <div id="box_cen_dos_a"><?php //echo $concurso->Empresa->name ?></div>
            <div id="box_cen_dos_b">Creado por Laruta</div>
            <div id="box_cen_dos_c">En <?php echo $concursocp->ConcursoEstado->name ?></div>
            <div id="box_cen_dos_d"><?php echo count($concursocp->ContribucionCp)?> Contribuciones</div>
        </div>
    </div>
    <div id="box_der">
        <div id="alin_der_img">
            <?php echo image_tag(basename(sfConfig::get('sf_upload_dir_name')) . "/" . $concursocp->ConcursoCategoria->image) ?>
        </div>
        <div id="alin_boton"><span class="align_ver_detalle">
                <?php echo link_to("ver detalle", "comunidadprivada/show?id=" . $concursocp->id) ?></span>
        </div>
    </div>
    <div id="box_botoon">Introducción: 
        <?php echo truncate_text($concursocp->incidencia,$length = 220)?>
   </div>
</div>