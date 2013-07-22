<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo get_partial('user_product_case_study_request/created_at', array('type' => 'list', 'user_product_case_study_request' => $user_product_case_study_request)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $user_product_case_study_request->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_marca">
  <?php echo $user_product_case_study_request->getMarca() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_modelo">
  <?php echo $user_product_case_study_request->getModelo() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_producto_tipo_uno_id">
  <?php echo $user_product_case_study_request->getProductoTipoUno() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_producto_tipo_dos_id">
  <?php echo $user_product_case_study_request->getProductoTipoDos() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_producto_tipo_tres_id">
  <?php echo $user_product_case_study_request->getProductoTipoTres() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_user_name">
  <?php echo $user_product_case_study_request->getUserName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_status">
  <?php echo get_partial('user_product_case_study_request/status', array('type' => 'list', 'user_product_case_study_request' => $user_product_case_study_request)) ?>
</td>
