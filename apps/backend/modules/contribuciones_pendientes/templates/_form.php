<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/JqueryAutocomplete.css') ?>
<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@contribuciones_pendientes') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('contribuciones_pendientes/form_fieldset', array('contribucion' => $contribucion, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('contribuciones_pendientes/form_actions', array('contribucion' => $contribucion, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
<style type="text/css">
    .sf_admin_form_field_archivo_1 table,.sf_admin_form_field_archivo_2 table,.sf_admin_form_field_archivo_3 table,
    .sf_admin_form_field_archivo_4 table,.sf_admin_form_field_archivo_5 table{
        margin-bottom: 0px !important;
    }
    .sf_admin_form_field_archivo_1 .content input:focus,.sf_admin_form_field_archivo_2 .content input:focus,.sf_admin_form_field_archivo_3 .content input:focus,
    .sf_admin_form_field_archivo_1 .content input:hover,.sf_admin_form_field_archivo_2 .content input:hover,.sf_admin_form_field_archivo_3 .content input:hover{
        background-color: #ffffff !important;
    }
    .sf_admin_form_field_archivo_1 td:hover{
        background: none !important;
    }
    .sf_admin_form_field_archivo_1 td{ padding: 0px !important;}
    .sf_admin_form_field_archivo_2 td{ padding: 0px !important;}
    .sf_admin_form_field_archivo_3 td{ padding: 0px !important;}
    .sf_admin_form_field_archivo_4 td{ padding: 0px !important;}
    .sf_admin_form_field_archivo_5 td{ padding: 0px !important;}
</style>
<?php if ($form->isNew()): ?>

    <script type="text/javascript">
        $("div[class*=sf_admin_form_field_archivo_] th").remove();
        //$("div[class*=sf_admin_form_field_archivo_] td").css('padding:0px;');
        $("div[class*=sf_admin_form_field_archivo_] td strong").remove();
        $("div[class*=sf_admin_form_field_archivo_] td br").remove();
        $("div[class*=sf_admin_form_field_archivo_] span#filename_uploaded1").remove();
        $("div[class*=sf_admin_form_field_archivo_] span#filename_uploaded2").remove();
        $("div[class*=sf_admin_form_field_archivo_] span#filename_uploaded3").remove();
        $("div[class*=sf_admin_form_field_archivo_] span#filename_uploaded4").remove();
        $("div[class*=sf_admin_form_field_archivo_] span#filename_uploaded5").remove();
                                                                    
        $("div[class*=sf_admin_form_field_archivo_] tr").attr('style','border:none');
    </script>
<?php endif; ?>


<script type="text/javascript">
    $("div[class*=sf_admin_form_field_archivo_] th").remove();
    $("div[class*=sf_admin_form_field_archivo_] td").attr('style','border:none');
    $("div[class*=sf_admin_form_field_archivo_] tr").attr('style','border:none');
</script>