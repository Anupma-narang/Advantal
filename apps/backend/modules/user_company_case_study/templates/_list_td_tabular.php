<td class="sf_admin_date sf_admin_list_td_created_at">
    <?php echo get_partial('user_company_case_study/created_at', array('type' => 'list', 'user_company_case_study' => $user_company_case_study)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
    <?php echo $user_company_case_study->getName() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_states_id">
    <?php echo $user_company_case_study->getStates() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_city_id">
    <?php if ($user_company_case_study->getCityId()): ?>
        <?php echo $user_company_case_study->getLocalidad()->getName(); ?>
    <?php else: ?>
        <?php echo $user_company_case_study->getStates(); ?>
    <?php endif; ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sectorName">
    <?php echo $user_company_case_study->getSectorName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_subSectorName">
    <?php echo $user_company_case_study->getSubSectorName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sector">
    <?php echo $user_company_case_study->getSectorTres() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_user_name">
    <?php echo $user_company_case_study->getUserName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_status">
    <?php echo get_partial('user_company_case_study/status', array('type' => 'list', 'user_company_case_study' => $user_company_case_study)) ?>
</td>
