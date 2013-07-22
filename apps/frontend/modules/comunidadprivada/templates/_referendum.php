<div id="content_detalle_referendums">

    <span class="referendum_top">
        <?php echo $concurso->name ?>

    </span>
    <span class="referendum_left">

    </span>
    <div id="referendum_right">
        <span class="box_right_referendum">
            <?php echo link_to("contribuciones", "contribucionuno/lista?concurso_id=" . $concurso->id) ?>
        </span>
        <span class="box_right_ver_refer">
            <?php //echo "ver contribucion"; ?>
        </span>   
    </div>

    <?php //echo link_to("Añadir Contribución","contribucionuno/new?concurso_id=".$contribucionactiva->id)?>
</div>
