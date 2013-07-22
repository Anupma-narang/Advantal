<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contribuciones_pendientes/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Contribuciones pendientes', array(), 'messages') ?></h1>

  <?php include_partial('contribuciones_pendientes/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('contribuciones_pendientes/list_header', array('pager' => $pager, 'type' => isset($type)?$type:null)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('contribuciones_pendientes/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('contribucion_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('contribuciones_pendientes/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('contribuciones_pendientes/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('contribuciones_pendientes/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('contribuciones_pendientes/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
<style>
    #contribucion_filters_concurso_id option{
        width:350px;
    }
</style>
<script language="javascript">
  $(document).ready(function() {
    if('<?php echo !count($filtershow);?>'){
        $("#sf_admin_bar").hide();
    }

    $("#sf_admin_bar").css('float', 'none');
    $("#sf_admin_bar").css('margin', 'auto');
    $("#sf_admin_bar").css('width', '490px');
    
    $(".sf_admin_list").css('padding-right', '0px');
    
  });
  
  $("#hide_show_filters").click(function(){
    $("#sf_admin_bar").toggle();
  });
</script>

