<?php use_helper('I18N', 'Date') ?>
<?php include_partial('profesionales_alertas/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Alertas de profesionales', array(), 'messages') ?></h1>

  <?php include_partial('profesionales_alertas/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('profesionales_alertas/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('profesionales_alertas/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('profesionales_alertas_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('profesionales_alertas/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('profesionales_alertas/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('profesionales_alertas/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('profesionales_alertas/list_footer', array('pager' => $pager)) ?>
  </div>
</div>

<script type="text/javascript">
$(window).load(function(){ jQuery('.sf_admin_list').css('padding-right', '100px');})
</script>