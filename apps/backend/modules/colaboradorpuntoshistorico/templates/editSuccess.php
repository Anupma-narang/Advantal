<?php use_helper('I18N', 'Date') ?>
<?php include_partial('colaboradorpuntoshistorico/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Editar histórico de colaboradores', array(), 'messages') ?></h1>

  <?php include_partial('colaboradorpuntoshistorico/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('colaboradorpuntoshistorico/form_header', array('colaboradorpuntoshistorico' => $colaboradorpuntoshistorico, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('colaboradorpuntoshistorico/form', array('colaboradorpuntoshistorico' => $colaboradorpuntoshistorico, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('colaboradorpuntoshistorico/form_footer', array('colaboradorpuntoshistorico' => $colaboradorpuntoshistorico, 'form' => $form, 'configuration' => $configuration)) ?>
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

