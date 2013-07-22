<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css'); ?>
<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@contactanos') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('contactanos/form_fieldset', array('contactanos' => $contactanos, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('contactanos/form_actions', array('contactanos' => $contactanos, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
<script type="text/javascript">

    $(document).ready(function() {
        $('div.content input[id=contactanos_user]').autocomplete("<?php echo url_for("sfAdminDash/usernameJsonList?id=id"); ?>").result(function(event, data) {
            var user_id = data[1];
            if (user_id) {
                //request for user details
                $.ajax({
                    url: '<?php echo url_for('/backend.php/contactanos/getDefaults'); ?>',
                    data: {id: user_id},
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        addValue('#contactanos_nombre', data.name);
                        addValue('#contactanos_email', data.email);
                        addValue('#contactanos_apellido1', data.surname1);
                        addValue('#contactanos_apellido2', data.surname2);
                        addValue('#contactanos_phone', data.phone);
                    }
                });
            } else {
                removeValue('#contactanos_nombre');
                removeValue('#contactanos_email');
                removeValue('#contactanos_apellido1');
                removeValue('#contactanos_apellido2');
                removeValue('#contactanos_phone');

            }
        });
        if ($('#contactanos_user_id').val()) {
            $('#contactanos_user_id').trigger('change');
        }

    });

    function addValue(obj, value) {
        if (value) {
            $(obj).val(value);
            $(obj).css('background', '#EEE');
            $(obj).attr('readonly', 'readonly');
        } else {
            $(obj).val('');
            $(obj).css('background', '#FFF');
            $(obj).removeAttr('readonly');
        }

    }
    function removeValue(obj) {
        $(obj).val('');
        $(obj).css('background', '#FFF');
        $(obj).removeAttr('readonly');
    }

    /*
     $(document).ready(function() {

     $('input#contactanos_user').keyup(function(e) {
     if (e.keyCode == 46) {
     $("input#contactanos_user_id").val('');
     }
     })
     $("input#contactanos_user").change(function() {
     $("input#contactanos_user_id").val('');
     });
     });
     */
</script>