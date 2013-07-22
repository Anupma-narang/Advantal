<div class="color_text" id="content_titulo_contribucion"> Detalle de Concurso </div>

<div id="content_concursos">
      
     <p align="center"><?php echo $concursocon->name?></p><hr>
     <p><?php echo "INCIDENCIA:   ".$concursocon->incidencia?> </p> <hr>
      <p><?php echo "Estado de concurso: ".$concursocon->ConcursoEstado->name?></p><hr>
      <p> <?php echo "Tipo Concurso: ". $concursocon->ConcursoTipo->name?> &nbsp;</p> <hr>
      <?php echo link_to("Añadir Fichero","fichero/new?concurso_id=".$concursocon->id) ?>

<!--     <p><?php //echo "id concurso: ". $concursocon->id?></p><hr>-->
 <div class="color_text" id="content_titulo_contribucion">Contribuciones</div>
 <?php foreach ($contribucionesactivas as $contribucion): ?>
    <?php include_partial("concurso/contribucionactiva", array("contribucion" => $contribucion)) ?>
 <?php endforeach; ?>
 
 <div class=file_list>
<?php if (count($concursocon->Fichero)):?>
<ul>
<?php foreach($concursocon->Fichero as $fichero):?>
<li><?php include_partial("concurso/fichero",array("fichero"=>$fichero))?></li>
<?php endforeach;?>
</ul>
<?php endif;?>
</div>
 
 
 
 <!-- 
 <div class="contribuciones">
    <?php //foreach ($concurso->Contribucion as $i=>$contribucion):?>
    <?php //include_partial("concurso/contribucion",array("contribucion"=>$contribucion,"orden"=>$i))?>
 <?php if (count($concursocon->Fichero)<5):?>

<?php echo link_to("Añadir Fichero","fichero/new?concurso_id=".$concursocon->id) ?>
<?php endif;?>   
 
 
 <p><?php //echo link_to("Añadir Fichero","fichero/new") ?></p>
    <?php //endforeach;?>
</div>
    <p>&nbsp;</p>
    
<?php //if($concurso->concurso_estado_id==2):?>
<p><?php // echo link_to("Añadir Contribución","contribucionuno/new?concurso_id=".$concurso->id)?></p>
<p><?php // echo link_to("Añadir Fichero","fichero/new?concurso_id=".$concurso->id)?></p>
<?php //endif;?>
-->
    </div>