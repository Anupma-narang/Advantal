<?php if ($field->isPartial()): ?>
  <?php include_partial('profesionales_pendientes/'.$name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
  <?php include_component('profesionales_pendientes', $name, array('type' => 'filter', 'form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
  <tr class="<?php echo $class ?>">
    <td>
      <?php echo $form[$name]->renderLabel($label) ?>
    </td>
    <td>
      <?php echo $form[$name]->renderError() ?>

      <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>

      <?php if ($help || $help = $form[$name]->renderHelp()): ?>
        <div class="help"><?php echo __($help, array(), 'messages') ?></div>
      <?php endif; ?>
    </td>
  </tr>
<?php endif; ?>

<script>

 function ceuta_melilla(f,g){
        var state2city = new Array();<?php foreach (StatesTable::getCiudadesAutonomas() as $city)  printf('state2city[%d]=%d;', $city['states_id'], $city['id']) ?>
        if(state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled","disabled");
    }
$(document).ready(function() {
        $("#profesional_filters_states_id").change(function(){ ceuta_melilla($(this),$("#profesional_filters_city_id")) });
        $("#frmProfesional").bind("submit",function(){$("#profesional_filters_city_id").removeAttr("disabled");});
        ceuta_melilla($("#profesional_filters_states_id"),$("#profesional_filters_city_id"));});
</script>