<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/JqueryAutocomplete.css') ?>

<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@colaboradores_alertas') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('colaboradores_alertas/form_fieldset', array('alertas' => $alertas, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('colaboradores_alertas/form_actions', array('alertas' => $alertas, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
