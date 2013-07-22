<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo get_partial('user_company_case_study_request/created_at', array('type' => 'list', 'user_company_case_study_request' => $user_company_case_study_request)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $user_company_case_study_request->getName() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_empresa_sector_uno_id">
  <?php echo $user_company_case_study_request->getEmpresaSectorUno(); ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_empresa_sector_dos_id">
  <?php echo $user_company_case_study_request->getEmpresaSectorDos() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_empresa_sector_tres_id">
  <?php echo $user_company_case_study_request->getEmpresaSectorTres() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_States">
  <?php echo $user_company_case_study_request->getStates() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_city_id">
  <?php echo $user_company_case_study_request->getLocalidad(); ?>
</td>
<td class="sf_admin_text sf_admin_list_td_user_name">
  <?php echo $user_company_case_study_request->getUserName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_status">
  <?php echo get_partial('user_company_case_study_request/status', array('type' => 'list', 'user_company_case_study_request' => $user_company_case_study_request)) ?>
</td>
