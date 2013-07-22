<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php //include_optimized_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
      <div id="page">
                    <div id="page_top">
          
 <?php include_partial("global/header") ?>
               <?php include_partial("global/menu") ?>
          </div>
            <div id="page_middle">
          
 <?php //include_partial("global/header") ?>

  <div id="content">
    <!--inicio menu-->
    <?php //include_partial("global/menu") ?>
   
<!--fin menu-->
<?php //include_partial("nosotros/".sfContext::getInstance()->getActionName()."_img_lateral")?>
    <?php include_partial("nosotros/menu-left-nosotros") ?>
    <?php //include_component('directorio', 'categoriaProfesional', array('url' => 'lista_profesional'));?>
    
  
    
    
    <?php echo $sf_content ?>
 
  </div> <!--fin content-->
  

  
<?php // include_partial("nosotros/".sfContext::getInstance()->getActionName()."_menu_footer")?>
<!--  inicio footer-->
<?php //include_partial("nosotros/nosotros_servicios_footer_menu") ?>
            </div>
          <div id="page_botton">
 <?php include_partial("global/footer") ?>
          </div>
<!--  fin footer-->
      </div><!--fin page-->
 </body>
</html>
