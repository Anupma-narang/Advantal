<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contratanos/assets') ?>

<div id="sf_admin_container">

    <h1><?php echo __($type == 'company' ? 'Listado de formularios de Contrátanos para Empresa/Entidad' : 'Listado de formulario de Contrátanos de Profesional') ?></h1>
    <?php include_partial('contratanos/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('contratanos/list_header', array('pager' => $pager)) ?>
    </div>

    <div id="sf_admin_bar" class="filters_center" style="float: none;margin: auto;width: 400px;<?php echo (count($filtershow) <= 1) ? 'display: none;' : ''; ?>">
        <?php include_partial('contratanos/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
    </div>
    <?php if (count($filtershow) != 0): ?>
        <div class="clean clear clear_0" >&nbsp;</div>
    <?php endif; ?>
    <div id="sf_admin_content">
        <form action="<?php echo url_for('contratanos_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('contratanos/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'type' => $type)) ?>
            <ul class="sf_admin_actions">
                <?php include_partial('contratanos/list_batch_actions', array('helper' => $helper)) ?>
                <?php include_partial('contratanos/list_actions', array('helper' => $helper)) ?>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('contratanos/list_footer', array('pager' => $pager)) ?>
    </div>
</div>
<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $("#hide_show_filters").click(function() {
            $("#sf_admin_bar").toggle();
            sortProvinciaList("contratanos_filters_states_id");
        });
        autoProvincias = function(id) {
            var id = id;
            $('#contratanos_filters_states_id').change(function() {
                autoLocalidad(id);
            })
            autoLocalidad(id);

        }
        autoLocalidad = function(id) {
            var localidades = {'Ceuta': '', 'Melilla': '', 'Toda España': ''};
            var comboProvincia = $('#contratanos_filters_states_id');
            if (comboProvincia.find('option:selected').html() in localidades) {
                $('#contratanos_filters_city_id option:eq(1)').attr("selected", "selected");
                $('#contratanos_filters_city_id').attr('disabled', 'disabled');
            } else {
                $('#contratanos_filters_city_id').removeAttr('disabled');
            }
        }

        $(function() {
            autoProvincias();
        })
        $('.sf_admin_form_field_ayudar').prepend('<div id="error_max_length" style="display:none;">Has superado el límite para tu comentario.</div>');
    });
</script>
