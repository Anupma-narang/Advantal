<?php use_helper('I18N', 'Date') ?>
<?php include_partial('gift/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Editar regalo', array(), 'messages') ?></h1>

  <?php include_partial('gift/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('gift/form_header', array('gift' => $gift, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('gift/form', array('gift' => $gift, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('gift/form_footer', array('gift' => $gift, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>


<script type="text/javascript">
  $(".content div img").attr('width', '100px');
  $(".content div img").attr('height', '100px');
</script>