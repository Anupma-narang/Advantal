<?php use_helper('I18N', 'Date') ?>
<?php include_partial('concurso/assets') ?>

<div id="sf_admin_container">
    <?php
    $filtering_estados_tipos = sfContext::getInstance()->getUser()->getAttribute('concurso.filtering_estados_tipos', '', 'admin_module');
    if ($filtering_estados_tipos == "producto") {
        $title = "Listado de concursos de Producto";
    } else if ($filtering_estados_tipos == "empresa_entidad") {
        $title = "Listado de concursos de Empresa/Entidad";
    } else if ($filtering_estados_tipos == "referendum") {
        $title = "Listado de concursos en Referéndum";
    } else if ($filtering_estados_tipos == "deliberacion") {
        $title = "Listado de concursos en Deliberación";
    } else if ($filtering_estados_tipos == "observacion") {
        $title = "Listado de concursos en Observación";
    } else if ($filtering_estados_tipos == "rechazados") {
        $title = "Listado de concursos rechazados";
    } else if ($filtering_estados_tipos == "cerrados") {
        $title = "Listado de concursos cerrados";
    } else if ($filtering_estados_tipos == "nulos") {
        $title = "Listado de concursos nulos";
    } else if ($filtering_estados_tipos == "revision") {
        $title = "Listado de concursos en Revisión";
    } else if ($filtering_estados_tipos == "borrador") {
        $title = "Listado de concursos en Borrador";
    } else {
        $title = "Listado de concursos";
    }
    ?>
    <h1><?php echo __($title, array(), 'messages') ?></h1>

    <?php include_partial('concurso/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('concurso/list_header', array('pager' => $pager, 'type' => isset($type) ? $type : null)) ?>
    </div>
    
    <div id="sf_admin_bar"  align="center" style="float: none;margin: 0 auto;width: 100%;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('concurso/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>

    <div id="sf_admin_content">
        <form action="<?php echo url_for('concurso_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('concurso/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('concurso/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('concurso/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('concurso/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<style>
    select#concurso_filters_concurso_estado_id option:first-child{
        border-bottom: 1px solid;
    }
</style>

<script language="javascript">
    $(document).ready(function() {
        sortProvinciaList("concurso_filters_states_id");
    });

    function ceuta_melilla(f, g) {
        var state2city = new Array();<?php
        foreach (StatesTable::getCiudadesAutonomas() as $city)
            printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
            ?>

                    if (state2city[f.val()])
                        g.val(state2city[f.val()]).attr("disabled", "disabled");
                }
                $("#hide_show_filters").click(function() {
                    $("#sf_admin_bar").toggle();
                    $("#abc").toggle();
                });

                $(document).ready(function() {
                    $(".sf_admin_list").css('padding-right', '0px');

<?php if ($sf_user->hasFlash('alert')): ?>
            alert("<?php echo $sf_user->getFlash('alert') ?>");
<?php endif; ?>
        $("#concurso_filters_states_id").change(function() {
            ceuta_melilla($(this), $("#concurso_filters_city_id"))
        });
        $("#concurso_filters_states_id").each(function() {
            ceuta_melilla($(this), $("#concurso_filters_city_id"))
        });

        $('.featured').bind('click', function() {

            if (<?php echo $sf_user->getAttribute('is_compnay_limit_exceed') ? 1 : 0 ?>) {
                alert('<?php echo __('No puedes destacar más de 10 concursos de Empresa/Entidad en la Home.') ?>');
                return false;
            }
            else {
                if (<?php echo $sf_user->getAttribute('is_product_limit_exceed') ? 1 : 0 ?>) {
                    alert('<?php echo __('No puedes destacar más de diez concursos de Producto en la Home.') ?>');
                    return false;
                }
            }

        });
    });
</script>
