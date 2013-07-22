<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/JqueryAutocomplete.css') ?>
<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@cuestionario') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('cuestionario/form_fieldset', array('lista_cuestionario' => $lista_cuestionario, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('cuestionario/form_actions', array('lista_cuestionario' => $lista_cuestionario, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>
<style type="text/css">
    #sf_fieldset_none table:first-child{ float: left; margin-left: 5px;}
     ul.inline li {margin-left:0}
</style>
