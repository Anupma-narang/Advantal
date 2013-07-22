<?php /* <div style="clear: both;"></div>
  <?php $sf_user->setFlash('remember_last_state', true); ?>

  <h2 style="margin-top: 0px; padding: 0px;">Cartas de <?php echo ($sf_request->hasParameter('desaprobaciones') ? 'desaprobación' : 'recomendación'); ?></h2>

  <?php foreach ($profesional->getProfesionalRecommandLetter($profesional->getId()) as $key => $comentario): ?>
  <?php if ($comentario->getProfesionalLetterTypeId() == 1 && $key == 0): ?>
  <div class="comentario_box">
  <div class="titulo" style="color: #B41B1D;">
  <strong>Recomendación de alta de auditoscopia, <?php echo date_format(new DateTime($profesional->getCreatedAt()), 'd/m/Y') ?>:</strong>
  </div>
  </div>
  <?php endif; ?>

  <div class="comentario_box">
  <?php $username = $comentario->getUserName(); ?>
  <strong>
  <span style="color:#006400;font-weight: bold;"><?php echo $comentario->getName(); ?></span>, <span style="color: #FF1919;font-weight: bold;"><?php echo $comentario->getUserName(); ?></span>, <span style="font-weight: blod;color: #B41B1D;"><?php echo date_format(new DateTime($comentario['updated_at']), 'd/m/Y') ?></span>:
  </strong>
  <div class="comentario">
  <?php echo html_entity_decode($comentario->getDescription()); ?>
  </div>
  <?php if ($is_authenticated): ?>
  <?php $login_user = sfContext::getInstance()->getUser()->getUsername(); ?>
  <?php if ($login_user == $username && $comentario->getPlanAccion()): ?>
  <div class="comentario">
  <p>
  <?php echo link_to('ver Plan de acción', 'directorio/showPlanAccion?id=' . $comentario->getId(), array("class" => "plan_ver", "popup" => array("popWindow", "scrollbars=1,width=650,height=500, left=200"))) ?>
  </p>
  </div>
  <?php endif; ?>
  <?php endif; ?>
  </div>
  <?php endforeach; ?>
  <style type="text/css">
  #dialog .comentarios p, #dialog .comentario, #dialog .titulo {
  font-size: 14px;
  }
  p a.plan_ver{
  color: #F65E13 !important;
  }
  </style>
 * */ ?>
<?php
/*echo $letter_type_url;
exit;
echo url_for($letter_type_url, array('slug' => $profesional->getSlug()));
exit;*/
?>
<?php if ($pager->haveToPaginate()): ?>
    <?php //include_partial('global/pagination', array('pager' => $pager, 'ruta' => '@lista_profesional', 'params' => array()))   ?>
    <?php endif; ?>
    <?php foreach ($pager as $k => $comentario): ?>
    <div class="comentario_box">
    <?php $username = $comentario->getUserName(); ?>
        <strong>
            <span style="color:#006400;font-weight: bold;"><?php echo $comentario->getName(); ?></span>, <span style="color: #FF1919;font-weight: bold;"><?php echo $comentario->getUserName(); ?></span>, <span style="font-weight: blod;color: #B41B1D;"><?php echo date_format(new DateTime($comentario['updated_at']), 'd/m/Y') ?></span>:
        </strong>
        <div class="comentario">
    <?php echo html_entity_decode($comentario->getDescription()); ?>
        </div>
    </div>
<?php endforeach; ?>
<?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('global/pagination', array('pager' => $pager, 'ruta' => url_for($letter_type_url, array('slug' => $profesional->getSlug())), 'params' => array())) ?>
<?php endif; ?>
