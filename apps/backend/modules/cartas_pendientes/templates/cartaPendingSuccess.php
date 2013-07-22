<?php use_helper('I18N', 'Date', 'Form') ?>
<?php include_partial('cartas_pendientes/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Editar carta', array(), 'messages') ?></h1>

  <?php include_partial('cartas_pendientes/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('cartas_pendientes/form_header', array('profesional' => $profesional_letter, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php use_stylesheets_for_form($form) ?>
    <?php use_javascripts_for_form($form) ?>

    <div class="sf_admin_form">
    <form action="<?php echo url_for('@profesional_carta_pendientes_create?id='.$sf_params->get('id')) ?>"   method="post" name="<?php echo $form->getName(); ?>" id="<?php echo $form->getName(); ?>" enctype="multipart/form-data">
        <?php
            echo input_hidden_tag('letter_id', $sf_params->get('letter_id'), array('readonly' => true));
            echo $form->renderHiddenFields(false);
        ?>

        <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
        <?php endif; ?>

        <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('cartas_pendientes/form_fieldset', array('profesional_letter' => $profesional_letter, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
        <?php endforeach; ?>

        <?php include_partial('cartas_pendientes/form_actions', array('profesional_letter' => $profesional_letter, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </form>
    </div>

  </div>

  <div id="sf_admin_footer">
    <?php include_partial('cartas_pendientes/form_footer', array('profesional_letter' => $profesional_letter, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
<script type="text/javascript">
    jQuery("#profesional").submit(function(e) {

        jQuery("#profesional_first_name").removeAttr("disabled");
        jQuery("#profesional_last_name_one").removeAttr("disabled");
        jQuery("#profesional_last_name_two").removeAttr("disabled");
        jQuery("#profesional_address").removeAttr("disabled");
        jQuery("#profesional_numero").removeAttr("disabled");
        jQuery("#profesional_piso").removeAttr("disabled");
        jQuery("#profesional_puerta").removeAttr("disabled");
        jQuery("#profesional_profesional_estado_id").removeAttr("disabled");
        jQuery("#profesional_user_id").removeAttr("disabled");
        jQuery("#profesional_road_type_id").removeAttr("disabled");
        jQuery("#profesional_states_id").removeAttr("disabled");
        jQuery("#profesional_city_id").removeAttr("disabled");
        jQuery("#profesional_telefono").removeAttr("disabled");
        jQuery("#profesional_email").removeAttr("disabled");
        jQuery("#profesional_profesional_tipo_uno_id").removeAttr("disabled");
        jQuery("#profesional_profesional_tipo_dos_id").removeAttr("disabled");
        jQuery("#profesional_profesional_tipo_tres_id").removeAttr("disabled");

        jQuery("#profesional_first_name").attr('readonly', true);
        jQuery("#profesional_last_name_one").attr('readonly', true);
        jQuery("#profesional_last_name_two").attr('readonly', true);
        jQuery("#profesional_address").attr('readonly', true);
        jQuery("#profesional_numero").attr('readonly', true);
        jQuery("#profesional_piso").attr('readonly', true);
        jQuery("#profesional_puerta").attr('readonly', true);
        jQuery("#profesional_profesional_estado_id").attr('readonly', true);
        jQuery("#profesional_user_id").attr('readonly', true);
        jQuery("#profesional_road_type_id").attr('readonly', true);
        jQuery("#profesional_states_id").attr('readonly', true);
        jQuery("#profesional_city_id").attr('readonly', true);
        jQuery("#profesional_telefono").attr('readonly', true);
        jQuery("#profesional_email").attr('readonly', true);
        jQuery("#profesional_profesional_tipo_uno_id").attr('readonly', true);
        jQuery("#profesional_profesional_tipo_dos_id").attr('readonly', true);
        jQuery("#profesional_profesional_tipo_tres_id").attr('readonly', true);
    });
    $(document).ready(function() {
        $("li.sf_admin_action_save,.sf_admin_action_save_and_add input[type=submit]").click(function() {
            // Indicadores de excelencia
            $("#Error_max_length_incidencia").hide();
            var max_length = CKEDITOR.instances.profesional_ProfesionalLetter_description.config.txtMaxLength;
           // alert(max_length+ " = "+CKEDITOR.instances.profesional_ProfesionalLetter_description.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g ,'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length);

            if (CKEDITOR.instances.profesional_ProfesionalLetter_description.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g ,'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length >= max_length) {
                $("#Error_max_length_incidencia").show();
                return false;
            }

            // RECOMENDACIÓN
            $("#Error_max_length_plan_accion").hide();
            var max_length2 = CKEDITOR.instances.profesional_ProfesionalLetter_plan_accion.config.txtMaxLength;
           // alert(max_length2+ " = "+CKEDITOR.instances.profesional_ProfesionalLetter_plan_accion.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g ,'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length);

            if (CKEDITOR.instances.profesional_ProfesionalLetter_plan_accion.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g ,'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length >= max_length2) {
                $("#Error_max_length_plan_accion").show();
                return false;
            }
        });

        var msg = $("div.sf_admin_form_field_profesionalGoogleMap ul.error_list li").html();
        $("div.sf_admin_form_field_profesionalGoogleMap div.content div.error").html(msg);
        $("div.sf_admin_form_field_profesionalGoogleMap ul.error_list").hide();
    });
</script>
