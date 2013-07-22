<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('contribucion_contribuciones_destacadas_empresa_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0" style="width: 510px;">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'contribucion_contribuciones_destacadas_empresa_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
                    <?php
                    include_partial('contribuciones_destacadas_empresa/filters_field', array(
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
<script language="javascript">
    function ceuta_melilla(f,g){
        var state2city = new Array();
        state2city[1]=1;state2city[16]=5884;state2city[35]=5885;
        if(state2city[f.val()]) g.val(state2city[f.val()]).attr("disabled","disabled");
    }

    $(document).ready(function() {
        $("#contribucion_filters_states_id").change(function(){ ceuta_melilla($(this),$("#contribucion_filters_city_id")) });
        $("#contribucion_filters_states_id").each(function(){ ceuta_melilla($(this),$("#contribucion_filters_city_id")) });

    });
</script>