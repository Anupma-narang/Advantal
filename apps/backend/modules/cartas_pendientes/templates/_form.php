<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@profesional_letter') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('cartas_pendientes/form_fieldset', array('profesional_letter' => $profesional_letter, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('cartas_pendientes/form_actions', array('profesional_letter' => $profesional_letter, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>
<script>
$(document).ready(function() {
 // $('.sf_admin_form_field_ProfesionalLetter').prepend('<ul id="Error_max_length_incidencia" class="error_list" style="display:none;"><li>Has superado el espacio permitido para tu recomendación.</li></ul>');
     //   $('.sf_admin_form_field_active_reason').prepend('<ul id="Error_max_length_active_reason" class="error_list" style="display:none;"><li>Has superado el espacio permitido para tu Indicadores de excelencia.</li></ul>');
    });
</script>