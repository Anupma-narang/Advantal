<?php if ($field->isPartial()): ?>
  <?php include_partial('cartas_recomendacion/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
  <?php include_component('cartas_recomendacion', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
  <div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' errors' ?>">

    <?php if($name != 'ProfesionalLetter' && $name != 'archivo_1' && $name != 'archivo_2' && $name != 'archivo_3' && $name != 'archivo_4' && $name != 'archivo_5'): ?>
        <?php echo $form[$name]->renderError() ?>
    <?php endif;?>

    <?php /* if($name == 'description'): ?>
     <ul id="Error_max_length_incidencia" class="error_list" style="display:none">
         <li>Has superado el espacio permitido para tu recomendación.</li>
     </ul>
    <?php endif; */ ?>


    <div>
     <?php if($name == 'ProfesionalLetter'): ?>
            <?php echo $form[$name]->renderLabel('<strong>'.$form[$name]->renderLabelName().'</strong>'); ?> <!---->
        <?php else: ?>
            <?php echo $form[$name]->renderLabel($label); ?>
        <?php endif; ?>


      <div class="content"><?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?></div>

      <?php if ($help): ?>
        <div class="help"><?php echo __($help, array(), 'messages') ?></div>
      <?php elseif ($help = $form[$name]->renderHelp()): ?>
        <div class="help"><?php echo $help ?></div>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>
