<div class="color_text" id="content_titulo_ponencias"> Detalle de Mesa redonda </div>


<div id="content_ponencias">

          
     <p align="center"><?php echo $mesaredonda->name?></p>
     <p><?php echo "PONENCIA:   ".$mesaredonda->resumen?> </p>
     <p><?php echo "Estado de la M. Redonda :   ".$mesaredonda->MesaredondaEstado->name?> </p>
     
<!--     <p><?php //echo "id concurso: ". $concursocon->id?></p><hr>-->
 <div class="color_text" id="content_titulo_ponencias">Ponencias</div>
<!-- <div id="conten_mr_activas">-->


 <?php foreach ($mesaredonda->MesaredondaPonencia as $i=>$ponencia): ?>
    <?php include_partial("mesa_redonda/ponencias", array("ponencia" => $ponencia,"orden"=>$i)) ?>
 <?php endforeach; ?>    

<!--</div>-->
</div>


