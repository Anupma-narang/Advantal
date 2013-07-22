<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo get_partial('company_case_study/created_at', array('type' => 'list', 'company_case_study' => $company_case_study)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $company_case_study->getName(); ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_states_id">
  <?php echo get_partial('company_case_study/states_id', array('type' => 'list', 'company_case_study' => $company_case_study)) ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_city_id">
  <?php echo get_partial('company_case_study/city_id', array('type' => 'list', 'company_case_study' => $company_case_study)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sectorName">
  <?php echo $company_case_study->getSectorName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_subSectorName">
  <?php echo $company_case_study->getSubSectorName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sector">
  <?php echo $company_case_study->getActividadName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_status">
  <?php echo get_partial('company_case_study/status', array('type' => 'list', 'company_case_study' => $company_case_study)) ?>
</td>
