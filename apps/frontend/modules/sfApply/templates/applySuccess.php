<?php use_helper('jQuery') ?>
<?php use_stylesheet('forms.css') ?>
<?php use_javascript('passwordStrengthMeter.js') ?>
<?php use_stylesheet('smoothness/jquery-ui-1.8.18.custom.css') ?>
<?php use_stylesheet('jquery.autocompleter.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('jquery.filestyle.js') ?>
<?php include_stylesheets_for_form($form) ?>

<div id="content_breadcroum">
    <?php echo link_to("inicio", "home/index") ?> >> vosotros >> crear una cuenta
</div>
<div style="clear:both"></div>
<div class="auditoscopia_title">
    <br><h1><?php echo __('Alta de colaboradores') ?></h1>
    <?php echo link_to(__('Por qué crear una cuenta'), 'popup/porquecrearunacuenta', array("popup" => array("popWindow", "width=700,height=700, left=200"))) ?>
</div>

<form method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>
      name="sf_apply_apply_form" id="sf_apply_apply_form" class="form_login">
    <input type="hidden" name="step" value="<?php print $step ?>" />
    <?php if ($sf_user->hasFlash('errorregister')): ?>
        <ul class="error_list">
            <li style="font-weight: bold;"><?php echo $sf_user->getFlash('errorregister', ESC_RAW) ?></li>
        </ul>
    <?php endif; ?>
    <?php print $form->renderHiddenFields() ?>
    <?php
    $ma_vars = array('form' => $form, 'step' => $step);
    if (isset($thumbnail))
        $ma_vars['thumbnail'] = $thumbnail;
    ?>
    <?php include_partial('applySuccess_' . $step, $ma_vars) ?>
</form>