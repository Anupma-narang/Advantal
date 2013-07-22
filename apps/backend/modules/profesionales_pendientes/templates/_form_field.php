<?php use_javascript('ckeditor/ckeditor.js'); ?>
<?php if ($field->isPartial()): ?>
    <?php include_partial('profesionales_pendientes/' . $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('profesionales_pendientes', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' errors' ?>">
        <?php echo $form[$name]->renderError() ?>

        <?php /* if ($name == 'incidencia'): ?>
            <ul id="Error_max_length_incidencia" class="error_list" style="display:none">
                <li>Has superado el espacio permitido para tu recomendación.</li>
            </ul>
        <?php endif; */?>
        <?php /* if ($name == 'active_reason'): ?>
            <ul id="Error_max_length_active_reason" class="error_list" style="display:none">
                <li>Has superado el espacio permitido para tu recomendación.</li>
            </ul>
        <?php endif; */?>
        <div>
            <?php echo $form[$name]->renderLabel($label) ?>

            <div class="content"><?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?></div>

            <?php if ($help): ?>
                <div class="help"><?php echo __($help, array(), 'messages') ?></div>
            <?php elseif ($help = $form[$name]->renderHelp()): ?>
                <div class="help"><?php echo $help ?></div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
