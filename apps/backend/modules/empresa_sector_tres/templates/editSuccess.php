<?php use_helper('I18N', 'Date') ?>
<?php include_partial('empresa_sector_tres/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Editar actividad de Empresa/Entidad', array(), 'messages') ?></h1>

  <?php include_partial('empresa_sector_tres/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('empresa_sector_tres/form_header', array('empresa_sector_tres' => $empresa_sector_tres, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('empresa_sector_tres/form', array('empresa_sector_tres' => $empresa_sector_tres, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('empresa_sector_tres/form_footer', array('empresa_sector_tres' => $empresa_sector_tres, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
<style>
    #empresa_sector_tres_empresa_sector_uno_id{
        width:525px!important;
        max-width: 525px!important;
    }
    #empresa_sector_tres_empresa_sector_dos_id{
        width:525px!important;
        max-width: 525px!important;
    }
</style>
