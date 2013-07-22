<?php use_helper('I18N', 'Date') ?>
<?php include_partial('sfguarduser/assets') ?>

<div id="sf_admin_container">  
    <h1><?php echo __('Listado de colaboradores', array(), 'messages') ?></h1>

    <?php include_partial('sfguarduser/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('sfguarduser/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar" class="filters_center" style="float: none;margin: auto;width: 428px;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('sfguarduser/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
    
    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('sfguarduser_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('sfguarduser/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('sfguarduser/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('sfguarduser/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('sfguarduser/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<style type="text/css">
    .sf_admin_filter_field_created_at td:last-child{
        width: 260px;
    }
</style>
<script>
    $(document).ready(function() {
        if(<?php echo (isset($_GET['eid']) ? $_GET['eid'] : '0'); ?>){
            alert('Para borrar ese elemento necesitas antes borrar el concurso, empresa/entidad o producto que lo está utilizando.');
        }
        
        $(".sf_admin_list").css('padding-right', '0px');
        
        $("#hide_show_filters").click(function(){
            $("#sf_admin_bar").toggle();
            $("#abc").toggle();
        });    
    });
</script>