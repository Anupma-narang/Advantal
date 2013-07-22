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
    <?php if ($sf_request->getParameter('q') == 'submenuactive'): ?>
        <?php $c_class = $submenu_type == 'our_case_study' ? 'referendumselected' : 'historico_concurso'; ?>
        <?php $p_class = $submenu_type == 'user_case_study' ? 'referendumselected' : 'historico_concurso' ?>
    <?php else: ?>
        <?php $c_class = $submenu_type == 'our_case_study' ? 'referendum' : 'historico_concurso'; ?>
        <?php $p_class = $submenu_type == 'user_case_study' ? 'referendum' : 'historico_concurso'; ?>
    <?php endif; ?>
    <div id="<?php echo $c_class; ?>">
        <span class="concurso_link">
             <!-- <a href="<?php echo $our_link; ?>" class="<?php echo $c_class ?>" title="Nuestros casos de éxito">Nuestros casos de éxitos</a> -->
            <a href="javascript:void(0);" id="nuestrosAjex" class="<?php echo $c_class ?>" title="Nuestros casos de éxito">Nuestros casos de éxito</a>
        </span>
    </div>
    <div id="<?php echo $p_class; ?>">
        <span class="concurso_link">
            <!-- <a href="<?php echo $user_link; ?>" class="<?php echo $p_class ?>" title="Otros casos de éxito">Otros casos de éxito</a> -->
            <a href="javascript:void(0);" id="otrosAjex" class="<?php echo $p_class ?>" title="Otros casos de éxito">Otros casos de éxito</a>
        </span>
    </div>
</div>
<div class="cp-records float-left" id="subLinkChangeAjex">
    <?php if ($parent_menu_type == 'company'): ?>
        <?php $category_type = $submenu_type == 'our_case_study' ? 'CompanyCaseStudy' : 'UserCompanyCaseStudy'; ?>
        <?php include_partial('company_case_study_records', array('parent_menu_type' => $parent_menu_type, 'pager' => $pager, 'category_type' => $category_type, 'is_authenticated' => $is_authenticated, 'is_user_submitted' => ($submenu_type == 'user_case_study' ? true : false))); ?>
    <?php else: ?>
        <?php $category_type = $submenu_type == 'our_case_study' ? 'ProductCaseStudy' : 'UserProductCaseStudy'; ?>
        <?php include_partial('product_case_study_records', array('parent_menu_type' => $parent_menu_type, 'pager' => $pager, 'category_type' => $category_type, 'is_authenticated' => $is_authenticated, 'is_user_submitted' => ($submenu_type == 'user_case_study' ? true : false))); ?>
    <?php endif; ?>
</div>
<?php if ($parent_menu_type == 'company'): ?>
    <?php $our_link = '/vosotros/companyCaseStudyAjex'; ?>
    <?php $user_link = '/vosotros/userCompanyCaseStudyAjex'; ?>
    <?php $formulario_link = "/vosotros/userCompanyCaseStudyRequest"; ?>
<?php elseif ($parent_menu_type == 'product'): ?>
    <?php $our_link = '/vosotros/productCaseStudyAjex'; ?>
    <?php $user_link = '/vosotros/userProductCaseStudyAjex'; ?>
    <?php $formulario_link = "/vosotros/userProductCaseStudyRequest"; ?>
<?php endif; ?>
<script type="text/javascript">
    /*$('#nuestrosAjex').bind('click', function() {
     if (<?php echo $is_authenticated ? '1' : '0' ?>) {
     $('#otrosAjex').addClass('historico_concurso').removeClass('referendumselected');
     $('#otrosAjex').parent("span").parent("div").attr('id', 'historico_concurso');
     $(this).addClass('referendumselected').removeClass('referendum');
     $(this).parent("span").parent("div").attr('id', 'referendumselected');
     $.ajax({
     url: '<?php echo url_for($our_link); ?>',
     type: 'GET',
     contentType: 'html',
     data: {q: 'submenuactive'},
     success: function(data) {
     $('#updatCaseStudy').html(data);
     }
     });
     } else {
     $('#user_login').trigger('click');
     }
     });
     $('#otrosAjex').bind('click', function() {
     if (<?php echo $is_authenticated ? '1' : '0' ?>) {
     $('#nuestrosAjex').addClass('referendum').removeClass("referendumselected");
     $('#nuestrosAjex').parent("span").parent("div").attr('id', 'referendum');
     $(this).addClass('referendumselected').removeClass("referendum");
     $(this).parent("span").parent("div").attr('id', 'referendumselected');
     $.ajax({
     url: '<?php echo url_for($user_link); ?>',
     type: 'GET',
     contentType: 'html',
     data: {q: 'submenuactive'},
     success: function(data) {
     $('#subLinkChangeAjex').html(data);
     }
     });
     } else {
     $('#user_login').trigger('click');
     }
     });*/
</script>