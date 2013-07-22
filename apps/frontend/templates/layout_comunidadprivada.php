<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<link rel="shortcut icon" href="/favicon.ico" />
<?php include_stylesheets() ?>
<?php include_javascripts() ?>
</head>
<body>
	<div id="page">
		<div id="page_top">
			<?php include_partial("global/header") ?>
			<?php include_partial("global/menu") ?>
		</div>
		<div id="page_middle">
			<div id="content">
				<?php //include_partial("concurso/menu-left-concurso") ?>
				<div id="menu_side">
					<?php include_partial("comunidadprivada/menu-left-comunidadprivada") ?>
					<?php if(sfContext::getInstance()->getModuleName()=="comunidadprivada"&&sfContext::getInstance()->getActionName()=="show"):?>
					<?php include_component("comunidadprivada","contribucionesdestacadas") ?>
					<?php else:?>
					<?php //include_component("comunidadprivada","destacados") ?>
					<?php //include_component("comunidadprivada","semana") ?>
					<?php endif;?>
				</div>
				<div style="float: left; width: 650px;"><?php include_partial('global/flashes') ?></div>
				<?php include_partial("comunidadprivada/breadcroump") ?>
                <?php //include_partial("comunidadprivada/buscadorconcurso") ?>
				<?php echo $sf_content ?>
			</div>
			<!--fin content-->

		</div>
		<div id="page_botton">
			<?php include_partial("global/footer") ?>
		</div>	
	<!--fin page-->
	</body>
</html>
	