<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@contratanos_contratanos_professional') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('contratanos_professional/form_fieldset', array('contratanos' => $contratanos, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('contratanos_professional/form_actions', array('contratanos' => $contratanos, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
<script type="text/javascript" language="javascript">   
    $(document).ready(function(){
        autoProvincias = function (id) {
            var id = id;
            $('#contratanos_states_id').change(function () {
                autoLocalidad(id);
            })
            autoLocalidad(id);

        }
        autoLocalidad = function (id) {
            var localidades = { 'Ceuta':'', 'Melilla':'', 'Toda España' : '' };
            var comboProvincia = $('#contratanos_states_id');
            if (comboProvincia.find('option:selected').html() in localidades) {
                $('#contratanos_city_id option:eq(1)').attr("selected", "selected");
                $('#contratanos_city_id').attr('disabled', 'disabled');
            } else {
                $('#contratanos_city_id').removeAttr('disabled');
            }
        }
        
        $("form").bind("submit", function() {
            $("#contratanos_city_id").removeAttr("disabled");
        });

        $(function() {
            autoProvincias();
            /*  $('form').submit(function() {
               // $('#contratanos_city_id').removeAttr('disabled');
            }) */
        })

        $('.sf_admin_form_field_ayudar').prepend('<div id="error_max_length" style="display:none;">Has superado el límite para tu comentario.</div>');
    });
</script>
