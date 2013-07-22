<h2>Acciones sobre el profesional</h2>
<ul>
    <?php if ($profesional->profesional_estado_id == 1): ?>
        <li><?php echo link_to_function(image_tag("tick") . "Activar", 'submitForm()') ?></li>
        <li><?php echo link_to_function(image_tag("tick") . "Activar y siguiente", 'procesar_puntos_y_siguiente()'); ?></li>
        <li><?php echo link_to(image_tag("email") . "Sugerir modificaciones", "profesionalLista/rechazar?id=" . $profesional->id) ?></li>
    <?php endif; ?>


    <?php
    if ($profesional->profesional_estado_id == 2):
        if ($letterCount): // && $profesional->getNumeroVotantes()==0)):
            ?>
            <li><?php echo link_to_function(image_tag("revert") . "Deshacer estado", 'alert(\'Ya no puedes deshacer el estado de este profesional.\')') ?></li>
        <?php else: ?>
            <li><?php echo link_to(image_tag("revert") . "Deshacer estado", "profesionalLista/revertStatus?id=" . $profesional->id) ?></li>
        <?php endif; ?>
<?php endif; ?>

</ul>

<ul>
    <li class="sf_admin_action_edit"><?php echo link_to("Editar profesional", 'profesional_lista_edit', array('id' => $profesional->getId()), array('class' => 'sf_admin_action_edit')) ?></li>
    <li class="sf_admin_action_edit">
        <?php if (!$profesional->getFeatured()): ?>
            <?php echo link_to(__('Home', array(), 'messages'), 'profesionalLista/setFeatured?id=' . $profesional->getId(), array('class' => 'featured')) ?>
        <?php else: ?>
            <?php echo link_to(__('Quitar Home', array(), 'messages'), 'profesionalLista/removeFeatured?id=' . $profesional->getId(), array('class' => 'remove')) ?>
<?php endif; ?>
    </li>
    <li class="sf_admin_action_featured_order">
    <?php echo link_to(__('Orden Home', array(), 'messages'), 'profesionalLista/setFeaturedOrder?id=' . $profesional->getId(), array()) ?>
    </li>
<?php echo $helper->linkToDelete($profesional, array('params' => array(), 'confirm' => '¿Estás seguro?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
    <li> <?php echo link_to('volver a profesional', '@profesional_lista') ?></li>
</ul>


<script>
    var procesar_puntos_y_siguiente = function(){
        $("#Siguiente").val(1);
        submitForm();
    }

    var submitForm = function(){
        if(CKEDITOR.instances.profesional_active_active_reason.getData().replace(/(<.*?>)/ig,"").length > 0)
            document.getElementById("profesional_reason").submit();
        else
        {
            alert('Para publicar un profesional en el Directorio necesitas antes incluir los Indicadores de excelencia.');
            $("#Siguiente").val(0);
        }
    }
</script>
