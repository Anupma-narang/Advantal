<li class="sf_admin_action_volver">
  <?php echo link_to(__('Volver a contribuciones', array(), 'messages'), 'contribuciones_pendientes/volver', array()) ?>
</li>
<?php echo $helper->linkToNew(array(  'label' => 'Nueva contribución',  'params' =>   array(  ),  'class_suffix' => 'new',)) ?>
