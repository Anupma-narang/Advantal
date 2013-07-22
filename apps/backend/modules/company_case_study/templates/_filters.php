<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('company_case_study_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'company_case_study_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php
                    if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal()))
                        continue
                        ?>
                    <?php
                    include_partial('company_case_study/filters_field', array(
                        'name' => $name,
                        'attributes' => $field->getConfig('attributes', array()),
                        'label' => $field->getConfig('label'),
                        'help' => $field->getConfig('help'),
                        'form' => $form,
                        'field' => $field,
                        'class' => 'sf_admin_form_row sf_admin_' . strtolower($field->getType()) . ' sf_admin_filter_field_' . $name,
                    ))
                    ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>
<script type="text/javascript">
    function disableSectorTres() {
        if ($('#company_case_study_filters_empresa_sector_tres_id option').size() <= 1 && $('#company_case_study_filters_empresa_sector_dos_id option').size() > 1) {
            $('#company_case_study_filters_empresa_sector_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona actividad</option>');
            $('#company_case_study_filters_empresa_sector_tres_id').attr('disabled', 'disabled');
        }
        else {

            $('#company_case_study_filters_empresa_sector_tres_id').removeAttr('disabled');
        }
    }
    ;

    $(function () {
        disableSectorTres();
        $("#company_case_study_filters_empresa_sector_dos_id").change(function () {
            disableSectorTres();
            
            if($("#company_case_study_filters_empresa_sector_dos_id").val() == ''){
                $('#company_case_study_filters_empresa_sector_tres_id').attr('disabled', 'disabled');
            }
        })

        if($("#company_case_study_filters_empresa_sector_dos_id").val() == ''){
            $('#company_case_study_filters_empresa_sector_tres_id').removeAttr('disabled');
        }
        
        $('#company_case_study_filters_empresa_sector_dos_id').change(function(){
            if($('#company_case_study_filters_empresa_sector_tres_id option').size() == 1){
                $('#company_case_study_filters_empresa_sector_tres_id').attr('disabled','disabled');
            }
        });

        $('#company_case_study_filters_empresa_sector_dos_id').each(function(){
            //alert($('#concurso_producto_tipo_dos_id option:selected').val());
            if($('#company_case_study_filters_empresa_sector_dos_id option:selected').val()){
                if($('#company_case_study_filters_empresa_sector_tres_id option').size() == 1){
                    $('#company_case_study_filters_empresa_sector_tres_id').attr('disabled','disabled');
                }
            }
        });
    });  
</script>