<?php if ($field->isPartial()): ?>
    <?php include_partial('contribuciones_destacadas/' . $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('contribuciones_destacadas', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' errors' ?>">
        <?php echo $form[$name]->renderError(); ?>
        <div>
            <?php echo $form[$name]->renderLabel($label) ?>
            <div class="content">
                <?php if ($name == 'incidencia'): ?>
                    <ul id="Error_max_length_incidencia" class="error_list"
                        style="display: none">
                        <li>Has superado el espacio permitido para la descripción de la
                            incidencia.</li>
                    </ul>
                <?php elseif ($name == 'plan_accion'): ?>
                    <ul id="Error_max_length_plan_accion" class="error_list"
                        style="display: none">
                        <li>Has superado el espacio permitido para tu Plan de acción</li>
                    </ul>
                <?php elseif ($name == 'resumen'): ?>
                    <ul id="Error_max_length_resumen" class="error_list"
                        style="display: none">
                        <li>Has superado el espacio permitido para el resumen de tu Plan de acción.</li>
                    </ul>
                <?php endif; ?>
                <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
            </div>
            <?php if ($help): ?>
                <div class="help">
                    <?php echo __($help, array(), 'messages') ?>
                </div>
            <?php elseif ($help = $form[$name]->renderHelp()): ?>
                <div class="help">
                    <?php echo $help ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
