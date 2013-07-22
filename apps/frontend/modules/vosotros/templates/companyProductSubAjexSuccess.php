<?php if ($parent_menu_type == 'company'): ?>
    <?php $category_type = $submenu_type == 'our_case_study' ? 'CompanyCaseStudy' : 'UserCompanyCaseStudy'; ?>
    <?php include_partial('company_case_study_records', array('parent_menu_type' => $parent_menu_type, 'pager' => $pager, 'category_type' => $category_type, 'is_authenticated' => $is_authenticated, 'is_user_submitted' => ($submenu_type == 'user_case_study' ? true : false))); ?>
<?php else: ?>
    <?php $category_type = $submenu_type == 'our_case_study' ? 'ProductCaseStudy' : 'UserProductCaseStudy'; ?>
    <?php include_partial('product_case_study_records', array('parent_menu_type' => $parent_menu_type, 'pager' => $pager, 'category_type' => $category_type, 'is_authenticated' => $is_authenticated, 'is_user_submitted' => ($submenu_type == 'user_case_study' ? true : false))); ?>
<?php endif; ?>
<?php if ($parent_menu_type == 'company'): ?>
    <?php $our_link = '/vosotros/companyCaseStudyAjex'; ?>
    <?php $user_link = '/vosotros/userCompanyCaseStudy'; ?>
<?php elseif ($parent_menu_type == 'product'): ?>
    <?php $our_link = '/vosotros/productCaseStudyAjex'; ?>
    <?php $user_link = '/vosotros/userProductCaseStudy'; ?>
<?php endif; ?>
