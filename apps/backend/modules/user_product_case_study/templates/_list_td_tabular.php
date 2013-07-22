<td class="sf_admin_date sf_admin_list_td_created_at">
    <?php echo get_partial('user_product_case_study/created_at', array('type' => 'list', 'user_product_case_study' => $user_product_case_study)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
    <?php echo $user_product_case_study->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_marca">
    <?php echo $user_product_case_study->getMarca() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_modelo">
    <?php echo $user_product_case_study->getModelo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sector">
    <?php echo $user_product_case_study->getSector() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sub_sector">
    <?php echo $user_product_case_study->getSubSector() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_tipo">
    <?php echo $user_product_case_study->getTipoForListing() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_user_name">
    <?php echo $user_product_case_study->getUserName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_status">
    <?php echo get_partial('user_product_case_study/status', array('type' => 'list', 'user_product_case_study' => $user_product_case_study)) ?>
</td>
