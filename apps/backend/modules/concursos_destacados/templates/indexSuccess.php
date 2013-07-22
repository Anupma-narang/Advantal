<?php use_helper('I18N', 'Date') ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js'); ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css'); ?>
<?php include_partial('concursos_destacados/assets') ?>

<div id="sf_admin_container">

    <h1><?php echo __('Listado de concursos destacados', array(), 'messages') ?></h1>

    <?php include_partial('concursos_destacados/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('concursos_destacados/list_header', array('pager' => $pager, 'type' => isset($type) ? $type : null)) ?>
    </div>

    <div id="sf_admin_bar" class="filters_center" style="float: none;margin: auto;width: 430px;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('concursos_destacados/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('concurso_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('concursos_destacados/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('concursos_destacados/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('concursos_destacados/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('concursos_destacados/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<script language="javascript">
    $(document).ready(function() {
        $(".sf_admin_list").css('padding-right', '0px');
        sortProvinciaList("concurso_filters_states_id");

        $("#hide_show_filters").click(function() {
            $("#sf_admin_bar").toggle();
        });
    });
</script>

