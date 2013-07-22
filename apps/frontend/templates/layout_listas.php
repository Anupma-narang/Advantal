<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico"/>
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


        <div id="content_listas">
            <!--inicio menu-->


            <!--fin menu-->
            <div id="contenido_listas">
                <?php include_partial("listas/breadcroump") ?>
                <?php include_partial("listas/headerlistas") ?>
                <?php include_partial("listas/buscadorlistas") ?>





                <?php echo $sf_content ?>


            </div>
            <!-- fin contenido_listas-->

        </div>
        <!--fin content-->


        <!--  inicio footer-->
    </div>
    <div id="page_botton">
        <?php include_partial("global/footer") ?>
    </div>


    <!--  fin footer-->
</div>
<!--fin page-->
</body>
</html>
