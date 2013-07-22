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
                <div id="menu_side">
                <?php include_partial("mesa_redonda/menu-left-mesaredonda") ?>
                    <?php include_component("mesa_redonda","destacadas") ?>
                </div>
                
                <?php include_partial("mesa_redonda/breadcroum") ?>
                <div id="content_mesaredonda">
                    <?php include_component("mesa_redonda", "busquedaconcurso") ?>
                    <?php echo $sf_content ?>

                </div>


            </div> <!--fin content-->

            <!--  inicio footer menu
            <div id="menu_footer_concurso"></div> -->
            <!-- fin footer menu -->
            <!--  inicio footer-->
            <?php include_partial("global/footer") ?>
            <!--  fin footier-->
        </div><!--fin page-->
    </body>
</html>
