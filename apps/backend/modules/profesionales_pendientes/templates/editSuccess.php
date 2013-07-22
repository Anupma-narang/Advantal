<?php use_helper('I18N', 'Date') ?>
<?php include_partial('profesionales_pendientes/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Editar profesional', array(), 'messages') ?></h1>

    <?php include_partial('profesionales_pendientes/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('profesionales_pendientes/form_header', array('profesional' => $profesional, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('profesionales_pendientes/form', array('profesional' => $profesional, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('profesionales_pendientes/form_footer', array('profesional' => $profesional, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("li.sf_admin_action_save input[type=submit]").click(function() {
            // Indicadores de excelencia
            $("#Error_max_length_active_reason").hide();
            var max_length = CKEDITOR.instances.profesional_active_reason.config.txtMaxLength;
           // alert(max_length+ " = "+CKEDITOR.instances.profesional_active_reason.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g ,'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length);

            if (CKEDITOR.instances.profesional_active_reason.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g ,'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length >= max_length) {
                $("#Error_max_length_active_reason").show();
                return false;
            }

            // RECOMENDACIÓN
            $("#Error_max_length_incidencia").hide();
            var max_length2 = CKEDITOR.instances.profesional_incidencia.config.txtMaxLength;
          //  alert(max_length2+ " = "+CKEDITOR.instances.profesional_incidencia.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g ,'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length);

            if (CKEDITOR.instances.profesional_incidencia.getData().replace(/<[^>]*>/g, '').replace(/\s+/g, ' ').replace(/&\w+;/g ,'X').replace(/^\s*/g, '').replace(/\s*$/g, '').length >= max_length2) {
                $("#Error_max_length_incidencia").show();
                return false;
            }
        });

        var msg = $("div.sf_admin_form_field_profesionalGoogleMap ul.error_list li").html();
        $("div.sf_admin_form_field_profesionalGoogleMap div.content div.error").html(msg);
        $("div.sf_admin_form_field_profesionalGoogleMap ul.error_list").hide();
    });
</script>