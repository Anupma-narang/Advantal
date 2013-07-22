<div id="sf_admin_container">
    <h1><?php echo __('Detalle de categorías de excelencia', array(), 'messages') ?></h1>
    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <ul class="dragbox-content" style="min-height: 78px;">
                <li><strong>Medalla: </strong><?php echo $categoria_excelencia->getNombre(); ?></li>
                <li><strong>Valor mínimo: </strong><?php echo $categoria_excelencia->getValorMin(); ?></li>
                <li><strong>Valor máximo: </strong><?php echo $categoria_excelencia->getValorMax(); ?></li>
            </ul>

        </div>

        <ul class='sf_admin_actions' style="margin-left: 6px !important;">
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@categoria_excelencia', array('class' => 'sf_admin_action_cancel')) ?></li>
            <li class='sf_admin_action_edit'><?php echo link_to('Editar', 'categoria_excelencia_edit', array('id' => $categoria_excelencia->getId()), array('class' => 'sf_admin_action_edit')) ?></li>
        </ul>
    </div>
</div>
