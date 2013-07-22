<?php use_helper('I18N', 'Date') ?>
<?php include_partial('concursos_destacados/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Nuevo concurso destacado', array(), 'messages') ?></h1>

  <?php include_partial('concursos_destacados/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('concursos_destacados/form_header', array('concurso' => $concurso, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('concursos_destacados/form', array('concurso' => $concurso, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('concursos_destacados/form_footer', array('concurso' => $concurso, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
