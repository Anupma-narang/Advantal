<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css'); ?>
<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@auditanos') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('auditanos/form_fieldset', array('auditanos' => $auditanos, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('auditanos/form_actions', array('auditanos' => $auditanos, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>

<script type="text/javascript">
    $('.sf_admin_form_field_plan').prepend('<div id="error_max_length" style="display:none;">Has superado el espacio permitido para tu Plan de acción.</div>');
    $(document).ready(function() {
        $('div.content input[id=auditanos_user]').autocomplete("<?php echo url_for("sfAdminDash/usernameJsonList?id=id"); ?>").result(function(event, data) {
            var user_id = data[1];
            if (user_id) {
                //request for user details
                $.ajax({
                    url: '<?php echo url_for('/backend.php/auditanos/getDefaults')?>',
                    data: {id: user_id},
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                        addValue('#auditanos_email', data.email);
                    }
                });
            } else {
                removeValue('#auditanos_email');
            }

        });
        if ($('#auditanos_user_id').val()) {
            $('#auditanos_user_id').trigger('change');
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

</script>
