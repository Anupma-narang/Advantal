<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@contribucion') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('contribucion/form_fieldset', array('contribucion' => $contribucion, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('contribucion/form_actions', array('contribucion' => $contribucion, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
<script type="text/javascript">
    $('.sf_admin_form_field_description').prepend('<div id="Error_max_length_resumen" style="display:none;">Has superado el espacio permitido para la descripción del caso de éxito.</div>');
    $("div[class*=sf_admin_form_field_archivo_] th").remove();
    $("div[class*=sf_admin_form_field_archivo_] table").attr('style', 'margin-bottom: 0;');
    $("div[class*=sf_admin_form_field_archivo_] td").attr('style', 'border:none; padding: 0;');
    $("div[class*=sf_admin_form_field_archivo_] tr").attr('style', 'border:none');
    <?php if($form->isNew()): ?>
        $(".sf_admin_form_field_archivo_1 table tr td:first").find("strong").remove();
        $(".sf_admin_form_field_archivo_1 table tr td:first").find("br").remove();
        $(".sf_admin_form_field_archivo_2 table tr td:first").find("strong").remove();
        $(".sf_admin_form_field_archivo_2 table tr td:first").find("br").remove();
        $(".sf_admin_form_field_archivo_3 table tr td:first").find("strong").remove();
        $(".sf_admin_form_field_archivo_3 table tr td:first").find("br").remove();
        $(".sf_admin_form_field_archivo_4 table tr td:first").find("strong").remove();
        $(".sf_admin_form_field_archivo_4 table tr td:first").find("br").remove();
        $(".sf_admin_form_field_archivo_5 table tr td:first").find("strong").remove();
        $(".sf_admin_form_field_archivo_5 table tr td:first").find("br").remove();
        $("span[id*=filename_uploaded]").remove();
    <?php endif; ?>
</script>
