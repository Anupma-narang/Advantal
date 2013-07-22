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
			<div id="content_home">
				<!--inicio menu-->
				<!--fin menu-->
				<div id="contenido_home">
					<?php include_partial('global/flashes', array('error_form' => false)) ?>
					<?php echo $sf_content ?>
				</div>
        <div id="content_footer"></div>
			</div>
			<!--fin content-->
		</div>
		<!--  inicio footer-->
		<div id="page_botton">
			<?php include_partial("global/footer") ?>
		</div>
		<!--  fin footer-->
	</div>
	<!--fin page-->
</body>
</html>
