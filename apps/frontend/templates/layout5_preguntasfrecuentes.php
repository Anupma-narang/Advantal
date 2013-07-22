<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <!-- disable iPhone inital scale -->
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <!-- html5.js para IE anterior a 9 -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!-- css3-mediaqueries.js para IE anterior a 9 -->
        <!--[if lt IE 9]>
                <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->
        <?php //include_optimized_stylesheets() ?>
        <?php include_javascripts() ?>
        <?php include_slot('js_header'); ?> 
    </head>
    <body>
        <div id="page">
            <header id="page_top">
                <?php include_partial("global/header5") ?>
                <?php include_partial("global/menu5") ?>
            </header>
            <div class="clear"></div>
            <div id="page_middle">
                <div id="content">
                    <?php include_partial("preguntasfrecuentes/menu-left-nosotros") ?>
                    <div class="content_with_side">
                        <?php echo $sf_content ?>
                        <div class="pxh20"></div>
                        <div class="pxh20"></div>
                        <p>
                            <?php echo link_to('Vuelve a concursos', 'concurso/index', array('title' => 'Vuelve a concursos')) ?>
                        </p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div id="menu_footer">
                    <div id="menu_footer_texto"> 
                        <?php echo link_to("Inicio", "home/index", array('title' => 'Inicio')) ?> - 
                        <?php echo link_to("Cómo funcionamos", "nosotros/como", array('title' => 'Cómo funcionamos')) ?> - 
                        <?php echo link_to("Recompensas", "nosotros/sistema", array('title' => 'Recompensas')) ?> - 
                        <?php echo link_to("Nuestros servicios", "nosotros/nuestros", array('title' => 'Nuestros servicios')) ?>
                    </div>
                    <div id="menu_footer_boton">
                        <a href="#inicio"><?php echo image_tag("img/img_flecha_menu_footer.png", array('title' => 'Ir arriba')) ?></a>
                    </div>
                </div>
            </div>
            <footer id="page_botton">
                <?php include_partial("global/footer5") ?>
            </footer>
        </div>
        <?php include_partial("global/footer5_js"); ?>
        <?php include_slot('js_footer'); ?> 
    </body>
</html>
