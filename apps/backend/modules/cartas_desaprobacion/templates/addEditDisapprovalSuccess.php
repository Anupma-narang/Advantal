<?php use_helper('I18N', 'Date', 'Form') ?>
<?php include_partial('cartas_desaprobacion/assets') ?>

<div id="sf_admin_container">
    <h1>
        <?php
        if (!$sf_params->get('letter_id'))
            echo __('Nueva carta de desaprobación', array(), 'messages');
        else
            echo __('Editar carta de desaprobación', array(), 'messages');
        ?>
    </h1>

    <?php include_partial('cartas_desaprobacion/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('cartas_desaprobacion/form_header', array('profesional' => $profesional_letter, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php use_stylesheets_for_form($form) ?>
        <?php use_javascripts_for_form($form) ?>

        <div class="sf_admin_form">
            <form action="<?php echo url_for('@profesional_cartas_desaprobacion_create?id=' . $sf_params->get('id')) ?>"   method="post" name="<?php echo $form->getName(); ?>" id="<?php echo $form->getName(); ?>" enctype="multipart/form-data">
                <?php
                echo input_hidden_tag('letter_id', $sf_params->get('letter_id'), array('readonly' => true));
                echo $form->renderHiddenFields(false);
                ?>

                <?php if ($form->hasGlobalErrors()): ?>
                    <?php echo $form->renderGlobalErrors() ?>
                <?php endif; ?>

                <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
                    <?php include_partial('cartas_desaprobacion/form_fieldset', array('profesional_letter' => $profesional_letter, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
                <?php endforeach; ?>

                <?php include_partial('cartas_desaprobacion/form_actions', array('profesional_letter' => $profesional_letter, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
            </form>
        </div>

    </div>

    <div id="sf_admin_footer">
        <?php include_partial('cartas_desaprobacion/form_footer', array('profesional_letter' => $profesional_letter, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>


<script type="text/javascript">

    $('.sf_admin_form_field_ProfesionalLetter').find('div')
            .find('div.content')
            .find('table')
            .find('tr:eq(3)').find('td')
            .prepend('<ul class="error_list" id="Error_max_length_incidencia" style="display:none;"><li>Has superado el espacio permitido para tu desaprobación.</li></ul>');
    $('.sf_admin_form_field_ProfesionalLetter').find('div')
            .find('div.content')
            .find('table')
            .find('tr:eq(4)').find('td')
            .prepend('<ul class="error_list" id="Error_max_length_plan_accion" style="display:none;"><li>Has superado el espacio permitido para tu Plan de acción.</li></ul>');

    jQuery("#profesional").submit(function(e) {
        $('form#profesional').find('input[type=text], select, textarea').each(function() {
            var field_id = $(this).attr('id');
            if (field_id == "profesional_first_name" || field_id == "profesional_last_name_one" || field_id == "profesional_last_name_two" || field_id == "profesional_numero" || field_id == "profesional_piso"
                    || field_id == "profesional_puerta" || field_id == "profesional_profesional_estado_id" || field_id == "profesional_user_id" || field_id == "profesional_road_type_id" || field_id == "profesional_states_id"
                    || field_id == "profesional_city_id" || field_id == "profesional_telefono" || field_id == "profesional_email" || field_id == "profesional_profesional_tipo_uno_id" || field_id == "profesional_address"
                    || field_id == "profesional_profesional_tipo_dos_id" || field_id == "profesional_profesional_tipo_tres_id"
                    ) {
                $('<input>').attr({type: 'hidden', id: $(this).attr('id'), name: $(this).attr('name'), value: $(this).val()}).appendTo('form');
            }
        });

//        jQuery("#profesional_first_name").removeAttr("disabled");
//        jQuery("#profesional_last_name_one").removeAttr("disabled");
//        jQuery("#profesional_last_name_two").removeAttr("disabled");
//        jQuery("#profesional_address").removeAttr("disabled");
//        jQuery("#profesional_numero").removeAttr("disabled");
//        jQuery("#profesional_piso").removeAttr("disabled");
//        jQuery("#profesional_puerta").removeAttr("disabled");
//        jQuery("#profesional_profesional_estado_id").removeAttr("disabled");
//        jQuery("#profesional_user_id").removeAttr("disabled");
//        jQuery("#profesional_road_type_id").removeAttr("disabled");
//        jQuery("#profesional_states_id").removeAttr("disabled");
//        jQuery("#profesional_city_id").removeAttr("disabled");
//        jQuery("#profesional_telefono").removeAttr("disabled");
//        jQuery("#profesional_email").removeAttr("disabled");
//        jQuery("#profesional_profesional_tipo_uno_id").removeAttr("disabled");
//        jQuery("#profesional_profesional_tipo_dos_id").removeAttr("disabled");
//        jQuery("#profesional_profesional_tipo_tres_id").removeAttr("disabled");
    });
    $(document).ready(function() {
        $("li.sf_admin_action_save,.sf_admin_action_save_and_add input[type=submit]").click(function() {
            // Indicadores de excelencia
            $("#Error_max_length_plan_accion").hide();
            var max_length = CKEDITOR.instances.profesional_ProfesionalLetter_plan_accion.config.txtMaxLength;
            // alert(max_length+ " = "+CKEDITOR.instances.profesional_active_reason.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g ,'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length);

            if (CKEDITOR.instances.profesional_ProfesionalLetter_plan_accion.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g, 'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length >= max_length) {
                $("#Error_max_length_plan_accion").show();
                return false;
            }

            // RECOMENDACIÓN
            $("#Error_max_length_incidencia").hide();
            var max_length2 = CKEDITOR.instances.profesional_ProfesionalLetter_description.config.txtMaxLength;
            //  alert(max_length2+ " = "+CKEDITOR.instances.profesional_incidencia.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g ,'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length);

            if (CKEDITOR.instances.profesional_ProfesionalLetter_description.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g, 'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length >= max_length2) {
                $("#Error_max_length_incidencia").show();
                return false;
            }
        });

        var msg = $("div.sf_admin_form_field_profesionalGoogleMap ul.error_list li").html();
        $("div.sf_admin_form_field_profesionalGoogleMap div.content div.error").html(msg);
        $("div.sf_admin_form_field_profesionalGoogleMap ul.error_list").hide();
    });
</script>