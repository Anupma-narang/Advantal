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
        <!--[if lt IE 9]>
        <script src="/js/html5shiv.js"></script>
        <![endif]-->
        <?php include_javascripts() ?>
        <?php include_slot('js_header'); ?> 
    </head>
    <body>
        <div class="content <?php include_slot('tamano'); ?> ">
            <?php echo $sf_content ?>
        </div>
        <?php include_partial("global/footer5_js"); ?>
        <?php 
        /*Comentado para evitar cargan en página de origen y delegar carga en ventana  nueva
        <script type="text/javascript">
            $(document).ready(function() {
                $("a").click(function() {
                    parent.window.location.href = $(this).attr("href");
                    parent.jQuery.fancybox.close();
                });
            });
        </script>
         * 
         */ ?>
        <?php include_slot('js_footer'); ?> 
    </body>
</html>
