<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_ver">
      <?php echo link_to(__('Ver', array(), 'messages'), 'user_company_case_study_request/show?id='.$user_company_case_study_request->getId(), array()) ?>
    </li>
    <?php echo $helper->linkToEdit($user_company_case_study_request, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($user_company_case_study_request, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    <li class="sf_admin_action_processed">
      <?php echo link_to(__('Tramitado', array(), 'messages'), 'user_company_case_study_request/processed?id='.$user_company_case_study_request->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_closed">
      <?php echo link_to(__('Cerrado', array(), 'messages'), 'user_company_case_study_request/closed?id='.$user_company_case_study_request->getId(), array()) ?>
    </li>
  </ul>
</td>
