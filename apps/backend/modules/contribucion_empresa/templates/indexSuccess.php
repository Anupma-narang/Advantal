<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contribucion_empresa/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Listado de contribuciones de Empresa/Entidad', array(), 'messages') ?></h1>

    <?php include_partial('contribucion_empresa/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('contribucion_empresa/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar">
        <?php include_partial('contribucion_empresa/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('contribucion_contribucion_empresa_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('contribucion_empresa/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('contribucion_empresa/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('contribucion_empresa/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('contribucion_empresa/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<script language="javascript">
    function ceuta_melilla(f,g){
        var state2city = new Array();<?php foreach (StatesTable::getCiudadesAutonomas() as $city)
            printf('state2city[%d]=%d;', $city['states_id'], $city['id']) ?>
        if(state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled","disabled");
    }

    $(document).ready(function() {
        if('<?php echo!count($filtershow); ?>'){
            $("#sf_admin_bar").hide();
        }
        $("#sf_admin_bar").css('float', 'none');
        $("#sf_admin_bar").css('margin', 'auto');
        $("#sf_admin_bar").css('width', '505px');

        $(".sf_admin_list").css('padding-right', '0px');

    });

    $("#hide_show_filters").click(function(){
        $("#sf_admin_bar").toggle();
    });


    $(document).ready(function() {
        sortProvinciaList("contribucion_filters_states_id");
        $("#contribucion_filters_states_id").change(function(){ ceuta_melilla($(this),$("#contribucion_filters_city_id")) });
        $("#frmProfesional").bind("submit",function(){$("#contribucion_filters_city_id").removeAttr("disabled");});
        ceuta_melilla($("#contribucion_filters_states_id"),$("#contribucion_filters_city_id"));});
</script>
