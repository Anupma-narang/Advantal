<?php use_helper('I18N', 'Date') ?>
<?php include_partial('planes_de_accion/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Listado de Planes de acción', array(), 'messages') ?></h1>

  <?php include_partial('planes_de_accion/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('planes_de_accion/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar" align="center">
    <?php include_partial('planes_de_accion/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('contribucion_planes_de_accion_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('planes_de_accion/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('planes_de_accion/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('planes_de_accion/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('planes_de_accion/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
<script language="javascript">
  $(document).ready(function() {
    if('<?php echo !count($filtershow);?>'){
        $("#sf_admin_bar").hide();
    }
    $("#sf_admin_bar").css('float', 'none');
    $("#sf_admin_bar").css('margin', 'auto');
    $("#sf_admin_bar").css('width', '100%');
    
    $(".sf_admin_list").css('padding-right', '0px');
    
  });
  
  $("#hide_show_filters").click(function(){
    $("#sf_admin_bar").toggle();
  });
  
    if($('#contribucion_filters_concurso_id option').size() == 1){
        $('#contribucion_filters_concurso_id option').attr('style','width:320px !important');
    }
    $('#contribucion_filters_concurso_tipo_id').change(function(){
        if($('#contribucion_filters_concurso_id option').size() == 1){
        $('#contribucion_filters_concurso_id option').attr('style','width:320px !important');
    }
    });
</script>

