<?php use_helper('I18N', 'Date') ?>
<?php include_partial('contratanos_professional/assets') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Nuevo formulario  Contrátanos para Profesional', array(), 'messages') ?></h1>

    <?php include_partial('contratanos_professional/flashes') ?>

    <div id="sf_admin_header">
        <?php include_partial('contratanos_professional/form_header', array('contratanos' => $contratanos, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>

    <div id="sf_admin_content">
        <?php include_partial('contratanos_professional/form', array('contratanos' => $contratanos, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>

    <div id="sf_admin_footer">
        <?php include_partial('contratanos_professional/form_footer', array('contratanos' => $contratanos, 'form' => $form, 'configuration' => $configuration)) ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        showBefore();
        showEmpresa();
        sortProvinciaList("contratanos_states_id");
        $('#contratanos_antes').bind('change', function(){
            showBefore();
        });
        $('#contratanos_eres').bind('change', function(){
            showEmpresa();
        });

        $("form").bind("submit", function() {
            $("#contratanos_city_id").removeAttr("disabled");
        });

    });
    function showBefore(){
        if($('#contratanos_antes').val() == 1){
            $('.sf_admin_form_field_what').show();
        }else{
            $('.sf_admin_form_field_what').hide();
        }
    }
    function showEmpresa(){
        if($('#contratanos_eres').val() == 2){
            $('.sf_admin_form_field_empresa').show();
        }else{
            $('.sf_admin_form_field_empresa').hide();
        }
    }

    function ceuta_melilla(f,g){
        var state2city = new Array();<?php foreach (StatesTable::getCiudadesAutonomas() as $city)
            printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
            ?>

                    if(state2city[f.val()]) g.val(state2city[f.val()]).attr("disabled","disabled");
                }
                $("#contratanos_states_id").change(function(){ ceuta_melilla($(this),$("#contratanos_city_id")) });
                $("#newContratanosForm").bind("submit",function(){$("#contratanos_city_id").removeAttr("disabled");});
                ceuta_melilla($("#contratanos_states_id"),$("#contratanos_city_id"));
</script>