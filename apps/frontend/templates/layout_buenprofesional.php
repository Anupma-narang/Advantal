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

  <div id="content_listas">
    <!--inicio menu-->
    <?php include_partial("global/menu") ?>
   
<!--fin menu-->
<div id="contenido_listas">
  <?php include_partial("buenprofesional/breadcroump") ?>
  <?php include_partial("buenprofesional/headerlistas") ?>
  <?php include_partial("buenprofesional/buscadorlistas") ?>
    
    
    
    

        <?php echo $sf_content ?>
 

</div> <!-- fin contenido_listas-->

  </div> <!--fin content-->
  
  
<!--  inicio footer-->
 <?php include_partial("global/footer") ?>
  

<!--  fin footer-->
      </div><!--fin page-->
 </body>
</html>
