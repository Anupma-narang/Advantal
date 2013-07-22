<?php use_helper('I18N', 'Date') ?>
<?php include_partial('gift_redemption/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Editar canje de regalo', array(), 'messages') ?></h1>

    <?php include_partial('gift_redemption/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('gift_redemption/form_header', array('gift_redemption' => $gift_redemption, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('gift_redemption/form', array('gift_redemption' => $gift_redemption, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('gift_redemption/form_footer', array('gift_redemption' => $gift_redemption, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>

<?php use_javascript('jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/JqueryAutocomplete.css') ?>

<style type="text/css">
    .newclass{
        background-color: #FF3333;
        border: medium none;
        color: #DD3333;
        margin: 0 0 7px;
    }
</style>


<script type="text/javascript">
    $(document).ready(function() {
        sortProvinciaList("gift_redemption_states_id");
    });
    function ceuta_melilla(f, g) {
        var state2city = new Array();<?php foreach (StatesTable::getCiudadesAutonomas() as $city)
            printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
            ?>
        if (state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled", "disabled");
    }
    $(document).ready(function() {

        $("#gift_redemption_states_id").change(function() {
            ceuta_melilla($(this), $("#gift_redemption_city_id"))
        });
        $("form").bind("submit", function() {
            $("#gift_redemption_city_id").removeAttr("disabled");
        });
        ceuta_melilla($("#gift_redemption_states_id"), $("#gift_redemption_city_id"));


    });
</script>