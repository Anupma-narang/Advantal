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
          
 <?php include_partial("global/header") ?>

  <div id="content">
    <!--inicio menu-->
    <?php include_partial("global/menu") ?>
   
<!--fin menu-->

  <?php include_partial("contribucionuno/menu-left-concurso") ?>
        <?php echo $sf_content ?>
 



  </div> <!--fin content-->
  
 <?php // include_partial("global/footer_menu") ?>  
  <?php //include_partial("vosotros/".sfContext::getInstance()->getActionName()."_menu_footer")?>
<!--  inicio footer-->
 <?php include_partial("global/footer") ?>
  

<!--  fin footer-->
      </div><!--fin page-->
 </body>
</html>
