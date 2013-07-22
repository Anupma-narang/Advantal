<?php use_helper('Date') ?>
<div id="mesaredonda_destacados">
    <span class="mesaredonda_titulo">Mesas redondas destacadas</span>
    <?php echo image_tag("img/linea_concursos_destacados.png") ?>

    <div align="left">
        <?php foreach ($destacadas as $destacada): ?>
    
        <div id="mesaredonda_nombre">
                <?php echo $destacada->name ?>
            </div>
            <div id="mesaredonda_fecha">
                <?php echo format_datetime($destacada->created_at, "p", "es_ES") ?> 
            </div>
        <div id="mesaredonda_categoria">
            
             <?php echo $destacada->MesaredondaCategoria->name ?>
        </div>
  <hr color="CCC">
        <?php endforeach; ?>


    </div>

</div>