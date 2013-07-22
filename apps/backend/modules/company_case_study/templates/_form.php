<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@company_case_study') ?>
  <?php echo $form->renderHiddenFields(false) ?>

  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

  <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
    <?php include_partial('company_case_study/form_fieldset', array('company_case_study' => $company_case_study, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
  <?php endforeach; ?>

  <?php include_partial('company_case_study/form_actions', array('company_case_study' => $company_case_study, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
<script type="text/javascript" language="javascript">
  $(document).ready(function(){
    autoProvincias = function (id) {
      var id = id;
      $('#company_case_study_states_id').change(function () {
        autoLocalidad(id);
      })
      autoLocalidad(id);

    }
    autoLocalidad = function (id) {
      var localidades = { 'Ceuta':'', 'Melilla':'', 'Toda España' : '' };
      var comboProvincia = $('#company_case_study_states_id');
      if (comboProvincia.find('option:selected').html() in localidades) {
        $('#company_case_study_city_id option:eq(1)').attr("selected", "selected");
        $('#company_case_study_city_id').attr('disabled', 'disabled');
      } else {
        $('#company_case_study_city_id').removeAttr('disabled');
      }
    }

    $(function() {
      autoProvincias();
      $('form').submit(function() {
        $('#company_case_study_city_id').removeAttr('disabled');
      })
    })
    $('.sf_admin_form_field_description').prepend('<div id="error_max_length" style="display:none;">Has superado el espacio permitido para la descripción del caso de éxito.</div>');
    $('.sf_admin_form_field_summary').prepend('<div id="error_max_length_summary" style="display:none;">Has superado el espacio permitido para el resumen del caso de éxito.</div>');
    // $('.sf_admin_form_field_comentario_inicial #error_max_length').remove();

  });
    
  function disableSectorTres() {
    if ($('#company_case_study_empresa_sector_tres_id option').size() <= 1 && $('#company_case_study_empresa_sector_dos_id option').size() > 1) {
      $('#company_case_study_empresa_sector_tres_id')
      .find('option')
      .remove()
      .end()
      .append('<option value="">Selecciona actividad</option>');
      $('#company_case_study_empresa_sector_tres_id').attr('disabled', 'disabled');
    }
    else
      $('#company_case_study_empresa_sector_tres_id').removeAttr('disabled');
  }
  ;

  $("#company_case_study_empresa_sector_uno_id").change(function(){
    if ($('#company_case_study_empresa_sector_uno_id option:selected').val()>0) {
      reorder_combobox('company_case_study_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id='+$('#company_case_study_empresa_sector_uno_id option:selected').val());
    }
  });
    
  $("#company_case_study_empresa_sector_dos_id").change(function () {
    // disableSectorTres();
    if ($('#company_case_study_empresa_sector_dos_id option:selected').val()>0) {
      reorder_combobox('company_case_study_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id='+$('#company_case_study_empresa_sector_dos_id option:selected').val());
    }
  });

  $("#concurso_producto_tipo_dos_id").change(function () {
    if ($('#concurso_producto_tipo_tres_id option').size() <= 1) {
      $('#concurso_producto_tipo_tres_id')
      .find('option')
      .remove()
      .end()
      .append('<option value="">Selecciona subsector</option>');
      $('#concurso_producto_tipo_tres_id').attr('disabled', 'disabled');
    }
    else
      $('#concurso_producto_tipo_tres_id').removeAttr('disabled');
  });
    
  $('#company_case_study_empresa_sector_dos_id').change(function(){
    if($('#company_case_study_empresa_sector_tres_id option').size() == 1){
      $('#company_case_study_empresa_sector_tres_id').attr('disabled','disabled');
    }
  });

  $('#company_case_study_empresa_sector_dos_id').each(function(){
    //alert($('#concurso_producto_tipo_dos_id option:selected').val());
    if($('#company_case_study_empresa_sector_dos_id option:selected').val()){
      if($('#company_case_study_empresa_sector_tres_id option').size() == 1){
        $('#company_case_study_empresa_sector_tres_id').attr('disabled','disabled');
      }
    }
  });
    
  // on ready
  $(function () {
    if ($("#company_case_study_empresa_sector_uno_id").length > 0) {
      reorder_combobox('company_case_study_empresa_sector_uno_id', 'ids_ordenados_concurso_empresa_sector_uno');
    }
    if ($('#company_case_study_empresa_sector_uno_id option:selected').val()>0) {
      reorder_combobox('company_case_study_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id='+$('#company_case_study_empresa_sector_uno_id option:selected').val());
    }
    if ($('#company_case_study_empresa_sector_dos_id option:selected').val()>0) {
      reorder_combobox('company_case_study_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id='+$('#company_case_study_empresa_sector_dos_id option:selected').val());
    }
  })
</script>