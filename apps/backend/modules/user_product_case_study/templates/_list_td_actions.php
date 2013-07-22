<td>
    <ul class="sf_admin_td_actions">
        <li class="sf_admin_action_ver">
            <?php echo link_to(__('Ver', array(), 'messages'), 'user_product_case_study/show?id=' . $user_product_case_study->getId(), array()) ?>
        </li>
        <?php echo $helper->linkToEdit($user_product_case_study, array('params' => array(), 'class_suffix' => 'edit', 'label' => 'Edit',)) ?>
        <?php echo $helper->linkToDelete($user_product_case_study, array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <li class="sf_admin_action_processed">
            <?php echo link_to(__('Tramitado', array(), 'messages'), 'user_product_case_study/processed?id=' . $user_product_case_study->getId(), array()) ?>
        </li>
        <li class="sf_admin_action_closed">
            <?php echo link_to(__('Cerrado', array(), 'messages'), 'user_product_case_study/closed?id=' . $user_product_case_study->getId(), array()) ?>
        </li>
    </ul>
</td>
