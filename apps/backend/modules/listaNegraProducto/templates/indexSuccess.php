<?php use_helper('I18N', 'Date') ?>
<?php include_partial('listaNegraProducto/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Lista negra de Productos', array(), 'messages') ?></h1>

    <?php include_partial('listaNegraProducto/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('listaNegraProducto/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar" class="filters_center" style="float: none;margin: auto;width: 490px;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('listaNegraProducto/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('producto_listaNegraProducto_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('listaNegraProducto/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('listaNegraProducto/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('listaNegraProducto/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('listaNegraProducto/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<style type="text/css">
    #producto_filters_marca,
    #producto_filters_name{ width: 225px !important;}
</style>
<script language="javascript">
    $(document).ready(function() {
        $(".sf_admin_list").css('padding-right', '0px');
    
<?php if ($sf_user->hasFlash('alert')): ?>
            alert("<?php echo $sf_user->getFlash('alert') ?>");
<?php endif; ?>
    });
    
    $('.featured').bind('click', function(){
        if(<?php echo $sf_user->getAttribute('is_limit_exceed') ? 1 : 0 ?>){
            alert('<?php echo __('No puedes destacar más de 10 empresas o entidades de la Lista negra en la Home.') ?>');
            return false;
        }
    });
    
    $("#hide_show_filters").click(function(){
        $("#sf_admin_bar").toggle();
    });
</script>