<li class="sf_admin_action_volver">
  <?php echo link_to(__('Volver al Listado', array(), 'messages'), 'concursos_pendientes/volver', array()) ?>
</li>
<?php echo $helper->linkToNew(array(  'label' => 'Nuevo concurso',  'params' =>   array(  ),  'class_suffix' => 'new',)) ?>
