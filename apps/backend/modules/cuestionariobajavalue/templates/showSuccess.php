<div id="sf_admin_container">
    <h1>Cuestionario de baja de <?php echo $cuestionario[0]->getUser() ?></h1>

    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <table>
                <thead><tr><th width="85%">Pregunta</td><th>Respuesta</td></tr></thead>
                <tbody>
                    <?php foreach ($cuestionario as $c): ?><tr>
                        <tr>
                            <td><?php echo $c->getCuestionarioPregunta()->getLabel() ?></td>
                            <?php
                            $respuesta = $c->getValue();
                            if ($respuesta == 'off')
                                $respuesta = 'NO';
                            elseif ($respuesta == 'on')
                                $respuesta = 'SI';
                            ?>

                            <td><?php echo $respuesta ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <ul class='sf_admin_actions' style="margin: 0px 0 0 0px !important;">
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@cuestionario_baja_value', array('class' => 'sf_admin_action_cancel')) ?></li>
        </ul>
    </div>
</div>
<style type="text/css">
    #sf_admin_content table{ width: 650px;}
</style>
<?php /*
 *
  <div id="sf_admin_container">
  <h1><?php echo __('Detalle de la baja de colaborador', array(), 'messages') ?></h1>

  <div id="sf_admin_content">
  <div class="sf_admin_list">
  <ul class="dragbox-content" style="min-height: 0px;">
  <li><strong>Pregunta: </strong><?php echo $cuestionario->getCuestionarioPregunta()->getLabel() ?></li>
  <?php $respuesta = $cuestionario->getValue(); ?>
  <?php if ($respuesta == 'off'): ?>
  <?php $respuesta = 'NO'; ?>
  <?php elseif ($respuesta == 'on'): ?>
  <?php $respuesta = 'SI'; ?>
  <?php endif; ?>
  <li><strong>Respuesta: </strong><?php echo $respuesta ?></li>
  </ul>
  </div>
  <ul class='sf_admin_actions' style="margin: 15px 0 0 6px !important;">
  <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@cuestionario_baja_value', array('class' => 'sf_admin_action_cancel')) ?></li>
  </ul>
  </div>
  </div>
 */
?>
<?php /*
  <div id="sf_admin_container">
  <h1><?php echo __('Detalle de la baja de colaborador', array(), 'messages') ?></h1>

  <div id="sf_admin_content">
  <div class="sf_admin_list">
  <table>
  <thead><tr><th width="50%">Pregunta</td><th>Respuesta</td></tr></thead>
  <tbody>
  <?php foreach ($cuestionario as $c): ?><tr>
  <tr>
  <td><?php echo $c->getCuestionarioPregunta()->getLabel() ?></td>
  <?php
  $respuesta = $c->getValue();
  if ($respuesta == 'off')
  $respuesta = 'NO';
  elseif ($respuesta == 'on')
  $respuesta = 'SI';
  ?>

  <td><?php echo $respuesta ?></td>
  </tr>
  <?php endforeach; ?>
  </tbody>
  </table>
  </div>
  <ul class='sf_admin_actions'>
  <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@cuestionario_baja_value', array('class' => 'sf_admin_action_cancel')) ?></li>
  </ul>
  </div>
  </div>
 */ ?>