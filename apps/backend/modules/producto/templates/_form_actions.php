<ul class="sf_admin_actions" style="margin: 10px 10px 10px 0 !important;">
    <?php if ($form->isNew()): ?>
        <?php echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('label' => 'Volver al Listado', 'params' => array(), 'class_suffix' => 'list',)) ?>
        <?php echo $helper->linkToSave($form->getObject(), array('params' => array(), 'class_suffix' => 'save', 'label' => 'Save',)) ?>
        <?php echo $helper->linkToSaveAndAdd($form->getObject(), array('label' => 'Guardar y crear otro', 'params' => array(), 'class_suffix' => 'save_and_add',)) ?>
    <?php else: ?>
        <?php echo $helper->linkToDelete($form->getObject(), array('params' => array(), 'confirm' => 'Are you sure?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
        <?php echo $helper->linkToList(array('label' => 'Volver al Listado', 'params' => array(), 'class_suffix' => 'list',)) ?>
        <?php echo $helper->linkToSave($form->getObject(), array('params' => array(), 'class_suffix' => 'save', 'label' => 'Save',)) ?>
        <?php echo $helper->linkToSaveAndAdd($form->getObject(), array('label' => 'Guardar y crear otro', 'params' => array(), 'class_suffix' => 'save_and_add',)) ?>
    <?php endif; ?>
</ul>
