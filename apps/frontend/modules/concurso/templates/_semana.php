<?php use_helper('Date','Text') ?>
<?php if($concurso_semana):?>
<div id="concurso_semana">
    <div id="concurso_semana_top"><div class="titulo">Concurso de la semana</div></div>
    <div id="concurso_semana_middle">
    	<?php include_partial('concurso/concurso_destacado_tiempo',array('concurso' => $concurso_semana))?>
	<br/>	
	</div>    
    <div id="concurso_semana_botton"></div>
</div>
<?php endif;?>

<?php if($concurso_mes):?>
<div id="concurso_mes">
    <div id="concurso_mes_top"><div class="titulo">Concurso del mes</div></div>
    <div id="concurso_mes_middle">
    	<?php include_partial('concurso/concurso_destacado_tiempo',array('concurso' => $concurso_mes))?>
    </div>
    <div id="concurso_mes_botton"></div>
</div>
<?php endif;?>

<?php if($concurso_anho):?>
<div id="concurso_year">
    <div id="concurso_year_top"> <div class="titulo"> Concurso del año</div></div>
    <div id="concurso_year_middle">
    	<?php include_partial('concurso/concurso_destacado_tiempo',array('concurso' => $concurso_anho))?>
    <br/>    
	</div>
	<div id="concurso_year_botton"></div>
</div>
<?php endif;?>