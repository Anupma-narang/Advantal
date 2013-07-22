<?php use_helper('I18N', 'Date') ?>
<?php include_partial('gift_redemption/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Listado de canje de regalos', array(), 'messages') ?></h1>

    <?php include_partial('gift_redemption/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('gift_redemption/list_header', array('pager' => $pager)) ?>
    </div>

    <div class="clear"></div>
    <div style="width:100%; padding-bottom: 8px;">
      <a id="hide_show_filters" href="javascript:void(0);" style=" bottom: 0;display: block;margin-right: 0;margin-top: -7px;right: 0;text-align: center;top: 0;width: 100%;"><strong>Esconder/Mostrar filtros</strong></a>
    </div>

    <div id="sf_admin_bar"  align="center" style="float: none;margin: 0 auto;width: 100%;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('gift_redemption/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
    
    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('gift_redemption_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('gift_redemption/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('gift_redemption/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('gift_redemption/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('gift_redemption/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        sortProvinciaList("gift_redemption_filters_states_id");
    });
    function ceuta_melilla(f, g) {
        var state2city = new Array();<?php
        foreach (StatesTable::getCiudadesAutonomas() as $city)
            printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
            ?>
        if (state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled", "disabled");
    }
    $(document).ready(function() {

        $("#gift_redemption_filters_states_id").change(function() {
            ceuta_melilla($(this), $("#gift_redemption_filters_city_id"))
        });
        
        $("form").bind("submit", function() {
            $("#gift_redemption_filters_city_id").removeAttr("disabled");
        });
        
        ceuta_melilla($("#gift_redemption_filters_states_id"), $("#gift_redemption_filters_city_id"));

        // hide/show filter form
        $("#hide_show_filters").click(function(){
            $("#sf_admin_bar").toggle();
        });

    });
</script>
