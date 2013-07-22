  <div id="menu_footer">
   <div id="menu_footer_texto"> 
       <?php echo link_to("Inicio","home/index")?> - 
       <?php echo link_to("Cómo funcionamos","nosotros/como")?> - 
       <?php echo link_to("Sistema de recompensas","nosotros/sistema")?> - 
       <?php echo link_to("Nuestros servicios","nosotros/nuestros")?>
   </div>
   <div id="menu_footer_boton">
  	<?php  echo link_to_function(image_tag("img/img_flecha_menu_footer.png"),"$('html, body').animate({ scrollTop: 0 }, 'fast');",array('title' => 'ir arriba'))?>
   </div>
  </div>
