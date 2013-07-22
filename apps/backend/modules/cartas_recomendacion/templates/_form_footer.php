<?php use_helper('jQuery'); ?>
<?php use_javascript('reorder_combobox.js') ?>
<script type='text/javascript'>
    $('.sf_admin_form_field_ProfesionalLetter').removeClass('errors');
    $('.sf_admin_form_field_ProfesionalLetter .error_list').each(function(){
        $(this).parent().addClass('errors')
    });
</script>

