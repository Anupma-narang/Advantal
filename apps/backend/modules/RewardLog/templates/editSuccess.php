<?php use_helper('I18N', 'Date') ?>
<?php include_partial('RewardLog/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Editar histórico de recompensas', array(), 'messages') ?></h1>

  <?php include_partial('RewardLog/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('RewardLog/form_header', array('reward_log' => $reward_log, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('RewardLog/form', array('reward_log' => $reward_log, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('RewardLog/form_footer', array('reward_log' => $reward_log, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>

<?php use_javascript('jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/JqueryAutocomplete.css') ?>

<style type="text/css">
    .newclass{
        background-color: #FF3333;
        border: medium none;
        color: #DD3333;
        margin: 0 0 7px;
    }
</style>

