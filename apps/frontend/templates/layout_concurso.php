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
                <div id="content">
                    <div id="menu_side">
                        <?php include_partial("concurso/menu-left-concurso") ?>
                      
                        <?php if(($sf_params->get('module')=='concurso' and ($sf_params->get('action')=='filterCompanyContest' || $sf_params->get('action')=='urlaliasshow')) or substr($sf_params->get('module'),0,7)=='contrib'):?>
                            <?php include_component("concurso", "contribucionesdestacadas") ?>
                      
                        <?php else: ?>
                            <?php include_component("concurso", "destacados") ?>
                            <?php include_component("concurso", "semana") ?>
                        <?php endif; ?>
                    <?php //include_component("concurso","destacados")  ?>
                    <?php //include_component("concurso","semana")  ?>
                    </div>
                    <div class="caja">
                        <?php include_partial('global/flashes') ?>
                        <?php echo $sf_content ?>
                    </div>
                </div>
                <!--fin content-->
                <?php   include_partial("concurso/menu_footer") ?>
            </div>
            <div id="page_botton">
                <?php include_partial("global/footer") ?>
            </div>
            <!--fin page-->
        </div>
        <?php include_partial('global/login_required') ?>
    </body>
</html>
