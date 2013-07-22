<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contribuciones_destacadas_producto/assets') ?>

<div id="sf_admin_container">

    <h1><?php echo __('Listado de contribuciones destacadas de Producto', array(), 'messages') ?></h1>

    <?php include_partial('contribuciones_destacadas_producto/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('contribuciones_destacadas_producto/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar"  align="center" style="float: none;margin: 0 auto;width: 100%;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('contribuciones_destacadas_producto/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('contribucion_contribuciones_destacadas_producto_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('contribuciones_destacadas_producto/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('contribuciones_destacadas_producto/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('contribuciones_destacadas_producto/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('contribuciones_destacadas_producto/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<script language="javascript">
    $(document).ready(function() {
        $("#sf_admin_bar").css('float', 'none');
        $("#sf_admin_bar").css('margin', 'auto');
        $("#sf_admin_bar").css('width', '490px');

        $(".sf_admin_list").css('padding-right', '0px');

    });

    $("#hide_show_filters").click(function(){
        $("#sf_admin_bar").toggle();
    });
</script>