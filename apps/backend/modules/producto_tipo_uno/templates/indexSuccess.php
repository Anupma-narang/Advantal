<?php use_helper('I18N', 'Date') ?>
<?php include_partial('producto_tipo_uno/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Listado de sectores de Producto', array(), 'messages') ?></h1>

  <?php include_partial('producto_tipo_uno/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('producto_tipo_uno/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('producto_tipo_uno/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('producto_tipo_uno_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('producto_tipo_uno/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('producto_tipo_uno/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('producto_tipo_uno/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('producto_tipo_uno/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
<style>
    .sf_admin_list table{
        width:91%;
    }
</style>
<script>
$(document).ready(function() {
    if(<?php echo $_GET['eid']; ?>){
        alert('Para borrar ese elemento necesitas antes borrar el concurso, empresa/entidad o producto que lo está utilizando.');
    }
});
</script>
