<div id="sf_admin_container">
    <h1><?php echo __('Detalle de la KPIs', array(), 'messages') ?></h1>
    <div id="sf_admin_content">
        <div class="sf_admin_list">
            <ul class="dragbox-content" style="min-height:52px;">
                <li><strong>KPI: </strong><?php echo $kpi->getNombre(); ?></li>
                <li><strong>Tipo: </strong><?php echo ($kpi->getTipo() == "empresa") ? "Empresa/Entidad" : $kpi->getTipo(); ?></li>
            </ul>
        </div>

        <ul class='sf_admin_actions'>
            <li class='sf_admin_action_list'><?php echo link_to('Volver al Listado', '@kpi', array('class' => 'sf_admin_action_cancel')) ?></li>
            <li class='sf_admin_action_edit'><?php echo link_to('Editar', 'kpi_edit', array('id' => $kpi->getId()), array('class' => 'sf_admin_action_edit')) ?></li>
        </ul>
    </div>
</div>
<style type="text/css">
    #sf_admin_container ul.sf_admin_actions { 
        float: left;
        width: 99%;
        margin: 10px 10px 10px 6px !important;
    }
</style>
<script type="text/javascript">
<?php if ($sf_user->hasFlash('alert')): ?>
        alert("<?php echo $sf_user->getFlash('alert') ?>");
<?php endif; ?>
</script>