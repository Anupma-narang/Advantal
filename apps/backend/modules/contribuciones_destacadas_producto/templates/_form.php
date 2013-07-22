<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/JqueryAutocomplete.css') ?>
<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@contribucion_contribuciones_destacadas_producto') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('contribuciones_destacadas_producto/form_fieldset', array('contribucion' => $contribucion, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('contribuciones_destacadas_producto/form_actions', array('contribucion' => $contribucion, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
<script type="text/javascript">
    $("div[class*=sf_admin_form_field_archivo_] th").remove();
    $("div[class*=sf_admin_form_field_archivo_] td").attr('style', 'border:none');
    $("div[class*=sf_admin_form_field_archivo_] tr").attr('style', 'border:none');
</script>