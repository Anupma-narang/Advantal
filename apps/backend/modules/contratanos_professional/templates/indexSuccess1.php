<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contratanos/assets') ?>

<div id="sf_admin_container">
  
  <h1><?php echo __($type == 'company' ? 'Listado de formulario de Contrátanos de Empresa/Entidad' :'Listado de formulario de Contrátanos de Profesional') ?></h1>
  <?php include_partial('contratanos/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('contratanos/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('contratanos/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('contratanos_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('contratanos/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'type' => $type)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('contratanos/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('contratanos/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('contratanos/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
