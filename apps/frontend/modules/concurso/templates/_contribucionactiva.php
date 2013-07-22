<?php use_helper('Date','Concursos') ?>
<div id="content_detalle_contribucion">
    <span class="box_superior">
        <? echo $contribucion->name ?>

    </span>
     <span class="box_left">
         <span class="color_fecha"><?php echo format_datetime($contribucion->created_at, "p", "es_ES") ?></span><br>
                <?php echo "Creada por: Apolo" ?><br>
                <?php echo "Resumen de la contribucion" ?>



     </span>
      <div id="box_right">
          <?php print link_to_contribuye($contribucion, 'box_right_contribuye') ?>
          <span class="box_right_ver">
              <?php echo "ver contribucion";?>
          </span>

      </div>

    <?php //echo link_to("Añadir Contribución","contribucionuno/new?concurso_id=".$contribucionactiva->id)?>
</div>

