<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('user_company_case_study_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'user_company_case_study_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal()))
                        continue ?>
                    <?php
                    include_partial('user_company_case_study/filters_field', array(
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
    $('#user_company_case_study_filters_empresa_sector_dos_id').change(function(){
        if($('#user_company_case_study_filters_empresa_sector_tres_id option').size() == 1){
            $('#user_company_case_study_filters_empresa_sector_tres_id').attr('disabled','disabled');
        }
    });

    $('#user_company_case_study_filters_empresa_sector_dos_id').each(function(){
        if($('#user_company_case_study_filters_empresa_sector_dos_id option:selected').val()){
            if($('#user_company_case_study_filters_empresa_sector_tres_id option').size() == 1){
                $('#user_company_case_study_filters_empresa_sector_tres_id').attr('disabled','disabled');
            }
        }
    });
</script>
<script language="javascript">
    function ceuta_melilla(f,g){
        var state2city = new Array();
        state2city[1]=1;state2city[16]=5884;state2city[35]=5885;
        if(state2city[f.val()]) g.val(state2city[f.val()]).attr("disabled","disabled");
    }

    function disableSectorTres() {
        if ($('#user_company_case_study_filters_empresa_sector_tres_id option').size() <= 1 && $('#user_company_case_study_filters_empresa_sector_dos_id option').size() > 1) {
            $('#user_company_case_study_filters_empresa_sector_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona tipo de producto</option>');
            $('#user_company_case_study_filters_empresa_sector_tres_id').attr('disabled', 'disabled');
        }else{
            $('#user_company_case_study_filters_empresa_sector_tres_id').removeAttr('disabled');
        }
    }

    $(document).ready(function() {
        $("#user_company_case_study_filters_states_id").change(function(){ ceuta_melilla($(this),$("#user_company_case_study_filters_city_id")) });
        $("#user_company_case_study_filters_states_id").each(function(){ ceuta_melilla($(this),$("#user_company_case_study_filters_city_id")) });

        $("#user_company_case_study_filters_empresa_sector_uno_id").change(function () {
            disableSectorTres();
            if ($('#user_company_case_study_filters_empresa_sector_uno_id option:selected').val()>0) {

            }
        });

        $('.featured').bind('click', function(){
            if(0){
                alert('No puedes destacar más de 10 concursos de Empresa/Entidad en la Home.');
                return false;
            }
            else{
                if(0){
                    alert('No puedes destacar más de diez concursos de Producto en la Home.');
                    return false;
                }
            }

        });
    });
</script>