<?php use_helper('Text') ?>
<?php if ($orden == 0): ?>
    <div class="contribucion_destacada"> <div id="contribucion_title"> <p>  <?php echo "Prime " . $contribucioncp->name ?></p> </div>
    <?php else: ?>
        <div class="contribucion_normal"> <div id="contribucion_title"> <p> <?php echo $contribucioncp->name ?></p></div>
   <?php endif; ?>
            
   <span class="box_left_contribuye">
            <?php //foreach ($contribucion->Fichero as $fichero): ?>
               <?php //include_partial("concurso/fichero", array("fichero" => $fichero)) ?>
            <?php //endforeach; ?>
   </span>
            
  <span class="box_right_contribuye">
   <?php if ($contribucioncp->ConcursoCp->concurso_estado_id == 2): ?>
           <?php //if (count($contribucioncp->Fichero) <= 5): ?>
                 <span class="box_right_contribuye_uno">
                <?php //echo link_to("añadir doc", "fichero/new?contribucion_id=" . $contribucioncp->id) ?>
                 </span>   
            <?php //endif; ?>
               <span class="box_right_contribuye_dos">
                <?php echo link_to("comenta", "comunidadprivadacomenta/new?concurso_cp_id=" . $contribucioncp->concurso_cp_id) ?>
               </span>
   <?php elseif ($contribucioncp->ConcursoCp->concurso_estado_id == 3): ?>
            <?php include_component("comunidadprivada", "votacion", array("contribucioncp" => $contribucioncp, "concursocp" => $contribucioncp->ConcursoCp)) ?>
   <?php endif; ?>
   </span>
             
   <div id="resumen_voto">RESUMEN:<?php //echo truncate_text($contribucioncp->resumen, $length = 180) ?>
   </div>
            
            
   </div> <!-- Fin contribucion -->