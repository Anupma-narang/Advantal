<?php if ($field->isPartial()): ?>
    <?php include_partial('cuestionario/' . $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
    <?php include_component('cuestionario', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
    <?php if ($form[$name]->getName() != 'ListaCuestionarioPregunta') : ?>
        <div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' errors' ?>">
            <?php echo $form[$name]->renderError() ?>
            <div>

            <?php endif ?>
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
<style type="text/css">
    fieldset#sf_fieldset_none table:first-child{
        float: left;
        margin: 0 0 0 5px;
    }
    label#Preguntas {
        font-weight: bold !important;
    }
    label#Preguntas {
        padding-left: 5px;
    }
    #sf_admin_container label{
        width: 11em !important;
    }

</style>
