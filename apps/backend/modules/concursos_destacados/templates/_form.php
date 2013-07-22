<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
    <?php echo form_tag_for($form, '@concursos_destacados', array('id' => 'frmConcursoDestacadas')) ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
        <?php include_partial('concursos_destacados/form_fieldset', array('concurso' => $concurso, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('concursos_destacados/form_actions', array('concurso' => $concurso, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</form>
</div>
<script>
    function ceuta_melilla(f,g){
        var state2city = new Array();<?php
    foreach (StatesTable::getCiudadesAutonomas() as $city)
        printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
        ?>

                if(state2city[f.val()]) g.val(state2city[f.val()]).attr("disabled","disabled");
            }
            $("#concurso_states_id").change(function(){ ceuta_melilla($(this),$("#concurso_city_id")) });
            $("#frmConcursoDestacadas").bind("submit",function(){$("#concurso_city_id").removeAttr("disabled");});
            ceuta_melilla($("#concurso_states_id"),$("#concurso_city_id"));
</script>