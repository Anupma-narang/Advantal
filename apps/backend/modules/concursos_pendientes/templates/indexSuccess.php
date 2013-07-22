<?php use_helper('I18N', 'Date') ?>
<?php include_partial('concursos_pendientes/assets') ?>

<div id="sf_admin_container">

    <h1><?php echo __('Concursos pendientes', array(), 'messages') ?></h1>

    <?php include_partial('concursos_pendientes/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('concursos_pendientes/list_header', array('pager' => $pager, 'type' => isset($type) ? $type : null)) ?>
    </div>

    <div id="sf_admin_bar" align="center" style="float: none;margin: auto;width: 100%;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('concursos_pendientes/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('concurso_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('concursos_pendientes/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('concursos_pendientes/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('concursos_pendientes/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('concursos_pendientes/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<script language="javascript">
    $(document).ready(function() {
        sortProvinciaList("concurso_filters_states_id");
    });

    function ceuta_melilla(f,g){
        var state2city = new Array();<?php
        foreach (StatesTable::getCiudadesAutonomas() as $city)
            printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
            ?>

                    if(state2city[f.val()]) g.val(state2city[f.val()]).attr("disabled","disabled");
                }

                $("#hide_show_filters").click(function(){
                    $("#sf_admin_bar").toggle();
                });

                $(document).ready(function() {
                    $("#concurso_filters_states_id").change(function(){ ceuta_melilla($(this),$("#concurso_filters_city_id")) });
                    $("#concurso_filters_states_id").each(function(){ ceuta_melilla($(this),$("#concurso_filters_city_id")) });
                    $(".sf_admin_filter_field_name label").html('Título');
                });
</script>
