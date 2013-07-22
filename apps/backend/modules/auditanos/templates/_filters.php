<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <form action="<?php echo url_for('auditanos_collection', array('action' => 'filter')) ?>" method="post">
        <table cellspacing="0" style="width: 100%">
            <tfoot>
                <tr>
                    <td colspan="2">
                        <?php echo $form->renderHiddenFields() ?>
                        <?php echo link_to(__('Reset', array(), 'sf_admin'), 'auditanos_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
                        <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
                    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal()))
                        continue ?>
                    <?php
                    include_partial('auditanos/filters_field', array(
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
    function ceuta_melilla(f,g){
        var state2city = new Array();<?php foreach (StatesTable::getCiudadesAutonomas() as $city)
    printf('state2city[%d]=%d;', $city['states_id'], $city['id']) ?>

        if(state2city[f.val()]) g.val(state2city[f.val()]).attr("disabled","disabled");
    }
    $("#auditanos_filters_states_id").change(function(){ ceuta_melilla($(this),$("#auditanos_filters_city_id")) });
    $("#newContratanosForm").bind("submit",function(){$("#auditanos_filters_city_id").removeAttr("disabled");});
    ceuta_melilla($("#auditanos_filters_states_id"),$("#auditanos_filters_city_id"));
</script>