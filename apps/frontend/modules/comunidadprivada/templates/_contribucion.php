<?php use_helper('Text','Concursos') ?>
<?php if ($orden == 0): ?>
    <div class="contribucion_destacada">  <div id="contribucion_title"> <p>  <?php echo "Prime " . $contribucion->name ?></p> </div>
    <?php else: ?>
        <div class="contribucion_normal"> <div id="contribucion_title"> <p> <?php echo $contribucion->name ?></p></div>
   <?php endif; ?>
   <span class="box_left_contribuye">
            <?php foreach ($contribucion->Fichero as $fichero): ?>
               <?php include_partial("concurso/fichero", array("fichero" => $fichero)) ?>
            <?php endforeach; ?>
   </span>
           <span class="box_right_contribuye">
   <?php if ($contribucion->Concurso->concurso_estado_id == 2): ?>
        <?php if (count($contribucion->Fichero) <= 5): ?>
              <span class="box_right_contribuye_uno">
             <?php echo link_to("añadir doc", "fichero/new?contribucion_id=" . $contribucion->id) ?>
              </span>
         <?php endif; ?>

         <?php print link_to_contribuye($contribucion) ?>
   <?php elseif ($contribucion->Concurso->concurso_estado_id == 3): ?>
        <?php include_component("concurso", "votacion", array("contribucion" => $contribucion, "concurso" => $contribucion->Concurso)) ?>
   <?php endif; ?>
   </span>

   <div id="resumen_voto">RESUMEN:<?php echo truncate_text($contribucion->resumen, $length = 180) ?>
   </div>


   </div> <!-- Fin contribucion -->