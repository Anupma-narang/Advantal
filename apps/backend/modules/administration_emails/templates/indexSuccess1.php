
<?php use_helper('I18N', 'Date') ?>
<?php include_partial('administration_emails/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Gestión de Caja', array(), 'messages') ?></h1>

  <?php include_partial('administration_emails/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('administration_emails/list_header', array('pager' => $pager)) ?>
  </div>
  <!-- <div>
    <table>
    <tr>
      <th>Caducidad de caja</th>
      <th>Puntos por céntimo</th>
      <th>Acciones</th>
    </tr>
    <tr>
      <td><?php echo $adminitration_caja[0]['expiry_date']?></td>
      <td><?php echo $adminitration_caja[0]['points_per_cent']?></td>
      <td><?php echo link_to('Editar', url_for('administration_caja_edit', array('id' => $adminitration_caja[0]['id'])))?></td>
    </tr>
  </table>
  </div>-->
  <div id="sf_admin_bar">
    <?php include_partial('administration_emails/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('administration_emails_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('administration_emails/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('administration_emails/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('administration_emails/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('administration_emails/list_footer', array('pager' => $pager)) ?>
  </div>
</div>

