<div id="menu_footer">
    <div id="menu_footer_texto">
        <a href="#">Inicio</a> -
        <a href="#">Cómo funcionamos</a> -
        <a href="#">Sistema de recompensas</a> -
        <a href="#">Nuestros servicios</a>
    </div>
    <div id="menu_footer_boton">
        <?php echo link_to_function(image_tag("img/img_flecha_menu_footer.png"), "$('html, body').animate({ scrollTop: 0 }, 'fast');", array('title' => 'ir arriba')) ?>
    </div>
</div>
