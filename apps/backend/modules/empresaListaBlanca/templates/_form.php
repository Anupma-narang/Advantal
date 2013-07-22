<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@empresa_lista_blanca', array('id' => 'form_empresa_lista_blanca')) ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('empresaListaBlanca/form_fieldset', array('empresa' => $empresa, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('empresaListaBlanca/form_actions', array('empresa' => $empresa, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
<style type="text/css">
    #sf_admin_container label{ padding: 0 !important}
    #sf_admin_container .cke_skin_kama .cke_editor { float: left; margin: 0 !important;}
</style>
<script type="text/javascript" language="javascript">   
    $(document).ready(function(){
        $('#empresa_lista').change(function(){
            var lista = $('#empresa_lista').val();
            if(lista == 'ln'){
                $('.sf_admin_form_field_texto_lista_negra').prepend('<div id="error_max_length" style="display:none;">Has superado el espacio permitido para el comentario.</div>');
                $('.sf_admin_form_field_comentario_inicial #error_max_length').remove();
            }
            if(lista == 'lb'){
                $('.sf_admin_form_field_comentario_inicial').prepend('<div id="error_max_length" style="display:none;">Has superado el espacio permitido para el comentario inicial.</div>');
                $('.sf_admin_form_field_texto_lista_negra #error_max_length').remove();
            }
        });
        
        $('#empresa_googleMap_lookup').click(function(){
            $('#empresa_gmap_check').val('true');
        });
        
        $('#empresa_googleMap_address').change(function(){
            $('#empresa_gmap_check').val('false');
        });
    });
</script>
