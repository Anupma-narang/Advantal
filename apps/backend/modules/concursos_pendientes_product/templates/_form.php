<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php $form->setDefault('concurso_tipo_id', '2');?>
<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@concurso_concursos_pendientes_product') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('concursos_pendientes_product/form_fieldset', array('concurso' => $concurso, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('concursos_pendientes_product/form_actions', array('concurso' => $concurso, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
