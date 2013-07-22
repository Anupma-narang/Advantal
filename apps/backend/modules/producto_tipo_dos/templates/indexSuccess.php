<?php use_helper('I18N', 'Date') ?>
<?php include_partial('producto_tipo_dos/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Listado de subsectores de Producto', array(), 'messages') ?></h1>

  <?php include_partial('producto_tipo_dos/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('producto_tipo_dos/list_header', array('pager' => $pager)) ?>
  </div>
<div align="center" style="float: none;margin: 0 auto;width: 100%;padding-bottom: 10px"><a id="hide_show" href="#"><strong>Esconder/Mostrar filtros</strong></a></div>
  <div id="sf_admin_bar" align="center" style="float: none;margin: 0 auto;width: 100%;">
    <?php include_partial('producto_tipo_dos/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('producto_tipo_dos_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('producto_tipo_dos/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('producto_tipo_dos/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('producto_tipo_dos/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('producto_tipo_dos/list_footer', array('pager' => $pager)) ?>
  </div>
</div>

<script>
$(document).ready(function() {
    var getvar = <?php echo $_GET ? $_GET['eid'] : 123 ?><?php echo ';'; ?>
    if(getvar == 1){
        alert('Para borrar ese elemento necesitas antes borrar el concurso, empresa/entidad o producto que lo está utilizando.');
    }
    
    if('<?php echo !count($filtershow);?>'){
        $("#sf_admin_bar").hide();
    }

    $("#hide_show").click(function(){
        $("#sf_admin_bar").toggle();
    });
});
</script>