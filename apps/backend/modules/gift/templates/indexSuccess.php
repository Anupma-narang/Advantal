<?php use_helper('I18N', 'Date') ?>
<?php include_partial('gift/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Listado de regalos', array(), 'messages') ?></h1>

  <?php include_partial('gift/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('gift/list_header', array('pager' => $pager)) ?>
  </div>

  <div class="clear"></div>
  <div style="width:100%; padding-bottom: 8px;">
    <a id="hide_show_filters" href="javascript:void(0);" style=" bottom: 0;display: block;margin-right: 0;margin-top: -7px;right: 0;text-align: center;top: 0;width: 100%;"><strong>Esconder/Mostrar filtros</strong></a>
  </div>

  <div id="sf_admin_bar"  align="center" style="float: none;margin: 0 auto;width: 100%;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
      <?php include_partial('gift/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>
  <?php if (count($filtershow) != 0): ?>
      <div class="clean clear clear_0" >&nbsp;</div>
  <?php endif; ?>

      
  <div id="sf_admin_content">
    <form action="<?php echo url_for('gift_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('gift/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('gift/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('gift/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('gift/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
<script type="text/javascript">
<?php if ($sf_user->hasFlash('alert')): ?>
      alert("<?php echo $sf_user->getFlash('alert') ?>");
<?php endif; ?>
  $(document).ready(function() {
    $('.featured').bind('click', function(){
      if(<?php echo $sf_user->getAttribute('is_limit_exceed') ? 1 : 0 ?>){
        alert('<?php echo __('No puedes destacar más de 6 regalos del Escaparate en la Home.') ?>');
        return false;
      }
    });
    // hide/show filter form
    $("#hide_show_filters").click(function(){
        $("#sf_admin_bar").toggle();
    });

  });
</script>