<?php use_stylesheet('caja.css') ?>
<?php $action = sfContext::getInstance()->getActionName(); ?>
<?php if ($action == 'companyCaseStudy' || $action == 'userCompanyCaseStudy'): ?>
    <?php $casetype = 'Empresa/Entidad'; ?>
<?php elseif ($action == 'productCaseStudy' || $action == 'userProductCaseStudy'): ?>
    <?php $casetype = 'Producto'; ?>
<?php endif; ?>

<div id="product_holder">
    <div id="content_vosotros">
        <?php echo include_partial('vosotros/breadcrumb', array('nombreSeccion' => 'Casos de éxito', 'tituloSeccion' => 'Casos de éxito', 'casetype' => $casetype, 'section' => $section)) ?>
        <h1><?php echo __('Cuéntanos tu caso de éxito'); ?></h1>
        <div class="float-left cp-records">
            <p>¿Eres una empresa y has conseguido alcanzar la Excelencia en tus productos o servicios?</p>
            <p>¿Eres una PYME y has consolidado tu negocio implantando un plan de mejora continua?</p>
            <p>¿Eres un consultor y has realizado un proyecto de Experiencia de Cliente especialmente interesante?</p>
            <p>Si conoces algún <strong>caso de éxito</strong> que quieras compartir con nosotros para que podamos ayudar mejor a los demás, rellena por favor este <a id="request_anchor" class="verde" href="javascript:void(0)" title="<?php echo __('Cuéntanos un caso de éxito') ?>" >formulario</a>.</p>
            <p>Además, te recompensamos con <strong>500 puntos</strong> que puedes acumular o canjear por el regalo que desees.</p>
            <p>¡Muchas gracias por tu contribución!</p>
            <p class="verde"><?php echo link_to("Inicio", "home/index", array('title' => 'Inicio')) ?></p>
            <p class="verde"><?php echo link_to("Nuestros servicios", "nosotros/nuestros", array('title' => 'Nuestros servicios')) ?></p>
            <p class="verde"><?php echo link_to("Cómo funcionamos", "nosotros/como", array('title' => 'Cómo funcionamos')) ?></p>
            <p class="verde"><a href="/preguntasfrecuentes/contrata#A" title="<?php echo __('¿Por qué contratar alguno de nuestros servicios?') ?>"><?php echo __('¿Por qué contratar alguno de nuestros servicios?') ?></a></p>
           <a name="top" id="top"></a>
        </div>
        
        <div class="float-left cp-records">
           <div class="parent">
                <div id="content_concursos_buscador" class="case_child">
                    <div class="cc-root">
                        <div id="boton_no_activo">
                            <span class="concurso_link">
                               <!-- <a href="/vosotros/companyCaseStudy" class="<?php echo $parent_menu_type == 'company' ? 'active' : ''; ?>" title="Casos de éxito de Empresa/Entidad">Empresa/Entidad</a> -->
                                <a href="javascript:void(0);" id="empresaentidadAjex" class="<?php //echo $parent_menu_type == 'company' ? 'active' : '';              ?>" title="Casos de éxito de Empresa/Entidad">Empresa/Entidad</a>
                            </span>
                        </div>
                        <div id="boton_no_activo">
                            <span class="concurso_link">
                                <!-- <a href="/vosotros/productCaseStudy" class="<?php echo $parent_menu_type == 'product' ? 'active' : ''; ?>" title="Casos de éxito de Producto">Producto</a>-->
                                <a href="javascript:void(0);" id="productAjex" class="<?php //echo $parent_menu_type == 'product' ? 'active' : '';              ?>" title="Casos de éxito de Producto">Producto</a>
                            </span>
                        </div>
                        <div>
                            <span class="cuentanos_caso_btn">
                                <?php if ($parent_menu_type == 'company'): ?>
                                    <?php $formulario_link = "/vosotros/userCompanyCaseStudyRequest"; ?>
                                <?php elseif ($parent_menu_type == 'product'): ?>
                                    <?php $formulario_link = "/vosotros/userProductCaseStudyRequest"; ?>
                                <?php endif; ?>
                                <?php if (!$is_authenticated): ?>
                                    <a id="request_anchor2" class="verde" href="javascript:void(0)" title="<?php echo __('Cuéntanos tu caso de éxito') ?>">
                                        Cuéntanos tu caso de éxito
                                    </a>
                                <?php else: ?>
                                    <a id="changeFrmLink" class="verde" href="<?php echo url_for($formulario_link); ?>" title="<?php echo __('Cuéntanos tu caso de éxito') ?>">
                                        Cuéntanos tu caso de éxito
                                    </a>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                    <?php
                    // for ajax pagination
                    if ($parent_menu_type == 'company') {
                        if ($submenu_type == "our_case_study") {
                            $PageTypeHolder = url_for('vosotros/companyCaseStudyPaging');
                        } elseif ($submenu_type == "user_case_study") {
                            $PageTypeHolder = url_for('vosotros/userCompanyCaseStudyPaging');
                        }
                    } else if ($parent_menu_type == 'product') {
                        if ($submenu_type == "our_case_study") {
                            $PageTypeHolder = url_for('vosotros/productCaseStudyPaging');
                        } elseif ($submenu_type == "user_case_study") {
                            $PageTypeHolder = url_for('vosotros/userProductCaseStudyPaging');
                        }
                    }
                    ?>
                    <input type="hidden" name="PageTypeHolder" id="PageTypeHolder" value="<?php echo $PageTypeHolder; ?>" />
                    
                    <div class="case_child" id="updatCaseStudy">
                        <?php if ($parent_menu_type == 'company'): ?>
                            <?php $c_class = 'active'; ?>
                            <?php $p_class = ''; ?>
                            <?php $our_link = '/vosotros/companyCaseStudy'; ?>
                            <?php $user_link = '/vosotros/userCompanyCaseStudy'; ?>
                            <?php /* $title = 'Casos de éxito de Empresa/Entidad'; ?>
                              <?php if ($submenu_type == 'our_case_study'): ?>
                              <?php $sub_title = 'Casos de éxito de Empresa/Entidad'; ?>
                              <?php endif; */ ?>
                        <?php elseif ($parent_menu_type == 'product'): ?>
                            <?php $c_class = ''; ?>
                            <?php $p_class = 'active'; ?>
                            <?php $our_link = '/vosotros/productCaseStudy'; ?>
                            <?php $user_link = '/vosotros/userProductCaseStudy'; ?>
                            <?php /* $title = 'Casos de éxito de Producto'; ?>
                              <?php else: ?>
                              <?php $title = 'Nuestros casos de éxito'; */ ?>
                        <?php endif; ?>
                        <div class="cc-root">
                            <div id="<?php //echo $c_class = ($submenu_type == 'our_case_study') ? 'referendumselected' : 'historico_concurso'               ?>">
                                <span class="concurso_link">
                                     <!-- <a href="<?php echo $our_link; ?>" class="<?php echo $c_class ?>" title="Nuestros casos de éxito">Nuestros casos de éxitos</a> -->
                                    <a href="javascript:void(0);" id="nuestrosAjex" class="<?php //echo $parent_menu_type == 'company' ? 'referendumselected' : '';              ?>" title="Nuestros casos de éxito">Nuestros casos de éxito</a>
                                </span>
                            </div>
                            <div id="<?php //echo $p_class = ($submenu_type == 'user_case_study') ? 'referendumselected' : 'historico_concurso'               ?>">
                                <span class="concurso_link">
                                    <!-- <a href="<?php echo $user_link; ?>" class="<?php echo $p_class ?>" title="Otros casos de éxito">Otros casos de éxito</a> -->
                                    <a href="javascript:void(0);" id="otrosAjex" class="<?php //echo $parent_menu_type == 'product' ? 'referendumselected' : '';              ?>" title="Otros casos de éxito">Otros casos de éxito</a>
                                </span>
                            </div>
                        </div>

                        <div id="AjaxPaging">
                            <div class="cp-records float-left" id="subLinkChangeAjex">
                                <?php if ($parent_menu_type == 'company'): ?>
                                    <?php $category_type = ($submenu_type == 'our_case_study') ? 'CompanyCaseStudy' : 'UserCompanyCaseStudy'; ?>
                                    <?php include_partial('company_case_study_records', array('parent_menu_type' => $parent_menu_type, 'pager' => $pager, 'category_type' => $category_type, 'is_authenticated' => $is_authenticated, 'is_user_submitted' => ($submenu_type == 'user_case_study' ? true : false))); ?>
                                <?php else: ?>
                                    <?php $category_type = ($submenu_type == 'our_case_study') ? 'ProductCaseStudy' : 'UserProductCaseStudy'; ?>
                                    <?php include_partial('product_case_study_records', array('parent_menu_type' => $parent_menu_type, 'pager' => $pager, 'category_type' => $category_type, 'is_authenticated' => $is_authenticated, 'is_user_submitted' => ($submenu_type == 'user_case_study' ? true : false))); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hidden" id="user_messagebox">
    <div class="border-box-n">
        <div class="header-left">
            <div class="header-right"></div>
        </div>
        <div class="top-left">
            <div class="top-right" >
                <div id="user_message_content" style="font-size:15px;"></div>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>
</div>
<a href="#user_messagebox" class="hidden" id="user_message_ancor">message box</a>
<div class="hidden" id="user_login_box">
    <div class="border-box-n">
        <div class="header-left">
            <div class="header-right"></div>
        </div>
        <div class="top-left">
            <div class="top-right" id="user_message_container">
                <div id="user_login_content">
                    <!--p><?php echo __('Para ') ?><strong><?php echo __('informarnos sobre un caso de éxito') ?></strong> <?php echo __(' necesitas ser colaborador.'); ?></p-->
                    <p style="font-size: 15px;">
                        <?php echo __('Para ') ?>
                        <strong><?php echo __('contarnos un caso de éxito') ?></strong>
                        <?php echo __(' necesitas ser colaborador.'); ?>
                    </p>
                    <ul class="bundle">
                        
                        <li style="font-size: 15px;"><?php echo link_to(__('ya soy colaborador'), url_for('/guard/login?redirect=' . $formulario_link), array('id' => 'loginFwdLinkChange','class' => 'underline' )) ?></li>
                        <li style="font-size: 15px;"><?php echo __('¿Aún no eres colaborador? ') ?> i<?php echo link_to(__('Crea una cuenta'), url_for('/registro'),array('class' => 'underline')) ?> <?php echo __(' ahora!'); ?></li>
                    </ul>
                    <br>
                </div>
            </div>
        </div>
        <div class="bottom-left">
            <div class="bottom-right"></div>
        </div>
    </div>
</div>
<a href="#user_login_box" class="hidden" id="user_login" onclick="$.fancybox.close();">message box</a>
<?php if ($parent_menu_type == 'company'): ?>
    <?php $our_link = '/vosotros/companyCaseStudyAjex'; ?>
    <?php $user_link = '/vosotros/userCompanyCaseStudyAjex'; ?>
    <?php $formulario_link = "/vosotros/userCompanyCaseStudyRequest"; ?>
<?php elseif ($parent_menu_type == 'product'): ?>
    <?php $our_link = '/vosotros/productCaseStudyAjex'; ?>
    <?php $user_link = ($submenu_type == 'our_case_study') ? '/vosotros/productCaseStudyAjex' : '/vosotros/userProductCaseStudyAjex'; ?>
    <?php $formulario_link = "/vosotros/userProductCaseStudyRequest"; ?>
<?php endif; ?>
<style type="text/css">
    .underline{
        text-decoration: none;
    }
    .underline:hover{
        text-decoration: underline;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $("#user_messagebox").fancybox({padding: 5});
        $("#user_login").fancybox({padding: 5});
        menu = '<?php echo $sf_user->getAttribute("menu") ?>';
        sub_menu = '<?php echo $sf_user->getAttribute("sub_menu") ?>';

        //if user is not authenticated then show login popup
        $('#request_anchor, #request_anchor2').bind('click', function() {
            if (<?php echo $is_authenticated ? '1' : '0' ?>) {
                window.location = '<?php echo $formulario_link ?>';
            } else {
                $('#user_login').trigger('click');
            }
        });

        $('#empresaentidadAjex').bind('click', function() {
            $('#productAjex').removeClass('active');
            $(this).addClass('active');
            if ($('#nuestrosAjex').hasClass('referendumselected')) {
                $("#PageTypeHolder").val("<?php echo url_for('vosotros/companyCaseStudyPaging'); ?>");
                $('#nuestrosAjex').trigger('click');
            } else {
                $("#PageTypeHolder").val("<?php echo url_for('vosotros/userCompanyCaseStudyPaging'); ?>");
                $('#otrosAjex').trigger('click');
            }
            /*if(sub_menu == "Nuestros"){
             $("#PageTypeHolder").val("<?php echo url_for('vosotros/companyCaseStudyPaging'); ?>");
             $('#nuestrosAjex').trigger('click');
             }else if(sub_menu == "Otros"){
             $("#PageTypeHolder").val("<?php echo url_for('vosotros/userCompanyCaseStudyPaging'); ?>");
             $('#otrosAjex').trigger('click');
             }
             $.ajax({
             url: $("#PageTypeHolder").val(),
             type: 'GET',
             contentType: 'html',
             data: {q: 'mainmenuactive'},
             success: function(data) {
             $('#subLinkChangeAjex').html(data);
             //$("#nuestrosAjex").addClass('referendumselected').removeClass("referendum");
             //$("#nuestrosAjex").parent("span").parent("div").attr('id', 'referendumselected');
             }
             });*/
            $('#changeFrmLink').attr('href', '<?php echo url_for('vosotros/userCompanyCaseStudyRequest'); ?>');
            $('#loginFwdLinkChange').attr('href', '<?php echo url_for('/guard/login?redirect=/vosotros/userCompanyCaseStudyRequest') ?>');
        });

        $('#productAjex').bind('click', function() {
            $('#empresaentidadAjex').removeClass('active');
            $(this).addClass('active');
            if ($('#nuestrosAjex').hasClass('referendumselected')) {
                $("#PageTypeHolder").val("<?php echo url_for('vosotros/companyCaseStudyPaging'); ?>");
                $('#nuestrosAjex').trigger('click');
            } else {
                $("#PageTypeHolder").val("<?php echo url_for('vosotros/userCompanyCaseStudyPaging'); ?>");
                $('#otrosAjex').trigger('click');
            }

            /*if(sub_menu == "Nuestros"){
             var pageType = <?php echo (($sf_user->hasAttribute('pagingNumberProduct')) ? $sf_user->getAttribute('pagingNumberProduct') : 1); ?>;
             $("#PageTypeHolder").val("<?php echo url_for('vosotros/productCaseStudyPaging'); ?>");
             }else if(sub_menu == "Otros"){
             var pageType = <?php echo (($sf_user->hasAttribute('pagingNumberProductUser')) ? $sf_user->getAttribute('pagingNumberProductUser') : 1); ?>;
             $("#PageTypeHolder").val("<?php echo url_for('vosotros/userProductCaseStudyPaging'); ?>");
             }
             var req_data = {q:'mainmenuactive',page:pageType};
             $.ajax({
             url: $("#PageTypeHolder").val(),
             type: 'GET',
             contentType: 'html',
             data:req_data,
             success: function(data) {
             $('#subLinkChangeAjex').html(data);
             //$("#nuestrosAjex").addClass('referendumselected').removeClass("referendum");
             //$("#nuestrosAjex").parent("span").parent("div").attr('id', 'referendumselected');
             //$("#PageTypeHolder").val("<?php echo url_for('vosotros/productCaseStudyPaging'); ?>");
             }
             });*/
            $('#changeFrmLink').attr('href', '<?php echo url_for('vosotros/userProductCaseStudyRequest'); ?>');
            $('#loginFwdLinkChange').attr('href', '<?php echo url_for('/guard/login?redirect=/vosotros/userProductCaseStudyRequest') ?>');
        });

        $('#nuestrosAjex').live('click', function() {
            var submenu = "<?php echo $submenu_type; ?>";
            var pageType = 1;
            if ($("#empresaentidadAjex").hasClass("active")) {
                pageType = <?php echo (($sf_user->hasAttribute('pagingNumberCompany')) ? $sf_user->getAttribute('pagingNumberCompany') : 1); ?>;
                $("#PageTypeHolder").val("<?php echo url_for('vosotros/companyCaseStudyPaging'); ?>");
            } else if ($("#productAjex").hasClass("active")) {
                pageType = <?php echo (($sf_user->hasAttribute('pagingNumberProduct')) ? $sf_user->getAttribute('pagingNumberProduct') : 1); ?>;
                $("#PageTypeHolder").val("<?php echo url_for('vosotros/productCaseStudyPaging'); ?>");
            }
            $('#otrosAjex').addClass('historico_concurso').removeClass('referendumselected');
            $('#otrosAjex').parent("span").parent("div").attr('id', 'historico_concurso');
            $(this).addClass('referendumselected').removeClass('referendum');
            $(this).parent("span").parent("div").attr('id', 'referendumselected');
            var req_data = {q: 'submenuactive', page: pageType};
            $.ajax({
                url: $("#PageTypeHolder").val(),
                type: 'GET',
                contentType: 'html',
                data: req_data,
                success: function(data) {
                    $('#subLinkChangeAjex').html(data);
                    if ($("#empresaentidadAjex").hasClass("active")) {
                        $("#PageTypeHolder").val("<?php echo url_for('vosotros/companyCaseStudyPaging'); ?>");
                    } else if ($("#productAjex").hasClass("active")) {
                        $("#PageTypeHolder").val("<?php echo url_for('vosotros/productCaseStudyPaging'); ?>");
                    }
                }
            });
            //            } else {
            //                $('#user_login').trigger('click');
            //            }
        });

        $('#otrosAjex').live('click', function() {
            var submenu = "<?php echo $submenu_type; ?>";
            //if (<?php echo $is_authenticated ? '1' : '0' ?> || submenu == 'user_case_study') {
            if ($("#empresaentidadAjex").hasClass("active")) {
                var pageType = <?php echo (($sf_user->hasAttribute('pagingNumberCompanyUser')) ? $sf_user->getAttribute('pagingNumberCompanyUser') : 1); ?>;
                $("#PageTypeHolder").val("<?php echo url_for('vosotros/userCompanyCaseStudyPaging'); ?>");
            } else if ($("#productAjex").hasClass("active")) {
                var pageType = <?php echo (($sf_user->hasAttribute('pagingNumberProductUser')) ? $sf_user->getAttribute('pagingNumberProductUser') : 1); ?>;
                $("#PageTypeHolder").val("<?php echo url_for('vosotros/userProductCaseStudyPaging'); ?>");
            }
            $('#nuestrosAjex').addClass('referendum').removeClass("referendumselected");
            $('#nuestrosAjex').parent("span").parent("div").attr('id', 'referendum');
            $(this).addClass('referendumselected').removeClass("referendum");
            $(this).parent("span").parent("div").attr('id', 'referendumselected');
            var req_data = {q: 'submenuactive', page: pageType};
            $.ajax({
                url: $("#PageTypeHolder").val(),
                type: 'GET',
                contentType: 'html',
                data: req_data,
                success: function(data) {
                    $('#subLinkChangeAjex').html(data);
                    if ($("#empresaentidadAjex").hasClass("active")) {
                        $("#PageTypeHolder").val("<?php echo url_for('vosotros/userCompanyCaseStudyPaging'); ?>");
                    } else if ($("#productAjex").hasClass("active")) {
                        $("#PageTypeHolder").val("<?php echo url_for('vosotros/userProductCaseStudyPaging'); ?>");
                    }
                }
            });
        });

        if (<?php echo $sf_user->hasFlash('case_success') ? 1 : 0 ?>) {
            $('#user_message_content').html("<?php echo html_entity_decode($sf_user->getFlash('case_success')) ?>");
            $("#user_messagebox").trigger('click');
        }

        if (menu == "Empresa/Entidad") {
            if (sub_menu == "Nuestros") {
                $("#PageTypeHolder").val("<?php echo url_for('vosotros/companyCaseStudyPaging'); ?>");
                $("#empresaentidadAjex").addClass("active");
                $('#nuestrosAjex').trigger('click');
            } else if (sub_menu == "Otros") {
                $("#PageTypeHolder").val("<?php echo url_for('vosotros/userCompanyCaseStudyPaging'); ?>");
                $("#empresaentidadAjex").addClass("active");
                $('#otrosAjex').trigger('click');

            }
        } else if (menu == "Producto") {
            if (sub_menu == "Nuestros") {
                $("#PageTypeHolder").val("<?php echo url_for('vosotros/productCaseStudyPaging'); ?>");
                $("#productAjex").addClass("active");
                $('#nuestrosAjex').trigger('click');
            } else if (sub_menu == "Otros") {
                $("#PageTypeHolder").val("<?php echo url_for('vosotros/userProductCaseStudyPaging'); ?>");
                $("#productAjex").addClass("active");
                $('#otrosAjex').trigger('click');
            }
        }
    });
</script>
<script type="text/javascript">
/*    $(document).ready(function() {
        $("div.pagination ul li:last").css("padding-left", "2px");
        $('.pagination a').live('click', function() {
         return false;
            page = this.href;
            var pattern = new RegExp("page=([0-9]+)");
            matches = page.match(pattern);
            url = $('#menu a.open:last').attr('data-link');
            loadingFront(undefined, matches[1], 'from_page');
            moveToTop();
            return false;
        });
    });*/

    function loadingFront(url, page, from) {
        if ($("#PageTypeHolder").val() == "") {
            var page_url = "<?php echo url_for('vosotros/companyCaseStudyPaging'); ?>";
        } else {
            var page_url = $("#PageTypeHolder").val();
        }

        base_url = page_url;
        $('#AjaxPaging').animate({
            'opacity': 0.25

        }, 200, function() {
        });
        $('#subLinkChangeAjex').html("<img src=/images/preloader-mini.gif alt='Loading'>");
        //load url...
        if (url == undefined) {
            if ($('#menu a.open:last').attr('data-link') != undefined) {
                url = $('#menu a.open:last').attr('data-link');
            } else {
                url = base_url;
            }
        }
        if (page) {
            url = url + '?page=' + page;
        }
        queryString = buildFilters(from);
        $.get(url, queryString, function(data) {
            updateFront(data);
        })
        
    }
    /**
     * Actualiza el front con los datos de "data".
     * @param data
     */
    function updateFront(data) {
        $('#AjaxPaging').animate({
            'opacity': 1

        }, 100, function() {
        });
        $('#subLinkChangeAjex').html(data);
        $(this).parent("span").parent("div").attr('id', 'referendumselected');
   return false;
   }

    function buildFilters(from) {
        //get filters of seach form
        buscador = $('#form_buscador');
        queryString = buscador.serializeArray();
        if (from == 'from_buscador') {
            queryString.push({
                name: 'from',
                value: 'buscador'
            });
        } else if (from == 'from_orden') {
            queryString.push({
                name: 'from',
                value: 'orden'
            });
        } else if (from == 'from_page') {
            //indiferente si cogemos valor de un o otro
            queryString.push({
                name: 'from',
                value: 'orden'
            });
        }

        order = $('#form_order');
        queryString = queryString.concat(order.serializeArray());
      //  alert(queryString);
        return queryString;
    }

   function moveToTop(jump_to) {
        if (jump_to == undefined) {
            jump_to = 'top';
        }
        var new_position = $('#' + jump_to).offset();
        window.scrollTo(null, new_position.top);
    }
</script>
