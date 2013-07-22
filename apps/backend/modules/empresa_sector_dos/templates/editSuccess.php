<?php use_helper('I18N', 'Date') ?>
<?php include_partial('empresa_sector_dos/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Editar subsector de Empresa/Entidad', array(), 'messages') ?></h1>

  <?php include_partial('empresa_sector_dos/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('empresa_sector_dos/form_header', array('empresa_sector_dos' => $empresa_sector_dos, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('empresa_sector_dos/form', array('empresa_sector_dos' => $empresa_sector_dos, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('empresa_sector_dos/form_footer', array('empresa_sector_dos' => $empresa_sector_dos, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
<style>
    #empresa_sector_dos_empresa_sector_uno_id{
        width:525px!important;
        max-width: 525px!important;
    }
</style>