<?php use_helper('Date','Text') ?>
<?php if($concurso_semana):?>
<div id="concurso_semana">
    <div id="titulo">Concurso de la semana</div>
    <div id="concurso_texto">
        <?php echo truncate_text($concurso_semana->incidencia,$length = 80) ?>
    </div>
    <div id="concurso_texto_footer">
         <?php echo $concurso_semana->name ?><br>
    </div>
</div>
<?php endif;?>

<?php if($concurso_mes):?>
<div id="concurso_mes">
    <div id="titulo">Concurso del mes</div>
    <div id="concurso_texto">
  <?php echo truncate_text($concurso_mes->incidencia,$length = 75) ?>
     </div>   
    <div id="concurso_texto_footer">
         <?php echo $concurso_mes->name ?><br>
    </div>
</div>
<?php endif;?>

<?php if($concurso_anho):?>
<div id="concurso_year">
    <div id="titulo"> Concurso del año</div>
    <div id="concurso_texto">     
    <?php echo truncate_text($concurso_anho->incidencia,$length = 60) ?>
     </div>
    <div id="concurso_texto_footer">
         <?php echo $concurso_anho->name ?><br>
    </div>
</div>
<?php endif;?>