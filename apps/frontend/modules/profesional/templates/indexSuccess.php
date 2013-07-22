<?php use_stylesheet('forms.css') ?>
<?php use_stylesheet('profesionals.css') ?>
<?php use_javascript('ckeditor/ckeditor.js') ?>
<?php use_javascript('reorder_combobox.js') ?>
<?php use_helper('Form') ?>

<?php $profesional_url = 'profesional/index'; ?>

<div id="content_breadcroum">
    <?php echo link_to("Inicio", "home/index") ?>
    >>
    <?php echo link_to('Las Listas', 'listaBlanca/index') ?>
    >>
    <?php echo link_to('Directorio de buenos profesionales', 'directorio/index') ?>
    >>
    <strong><?php echo __('nuevo profesional'); ?></strong>
</div>
<div id="content_laslistas_lista">
    <div class="content-top"></div>
    <div class="content-middle">
        <div id="content_laslistas_left">
            <?php include_component('directorio', 'categoriaProfesional', array('url' => 'lista_profesional')); ?>
        </div>
        <div id="content_laslistas_left_shadow"></div>
        <div id="content_laslistas_right">
            <div class="top">
                <div class="order">
                </div>
            </div>
            <div id="content-results1" class="main">
                <div class="top"></div>
                <div class="middle">

                    <?php if (isset($profesional_tipo_uno)): ?>
                        <div class="title">
                            <?php //echo image_tag('/images/uploads/thumbnails/' . $profesional_tipo_uno->getImage(), array('class' => 'miniatura-categoria')) ?>
                            <span><?php // echo $profesional_tipo_uno->getName()     ?></span>
                        </div>
                    <?php endif ?>

                    <div id='resultados_empresas1'>
                        <div class="border-box ML-5 MR-2">
                            <div class="top-left">
                                <div class="top-right">
                                    <h2 style="text-align:center;"><?php echo '<strong>RECOMIENDA UN NUEVO PROFESIONAL</strong>'; ?></h2>
                                </div>
                            </div>
                            <div class="bottom-left">
                                <div class="bottom-right"></div>
                            </div>
                        </div>
                        <?php if ($sf_user->hasFlash('error')): ?>
                            <ul class="error_list">
                                <li><?php echo $sf_user->getFlash('error', ESC_RAW) ?></li>
                            </ul>
                        <?php endif; ?>
                        <?php //include_partial('resultadosProfesional', array('pager' => $pager, 'profesionalDestacadas' => $profesionalDestacadas, 'buscandoPorSector' => $buscandoPorSector )); ?>
                        <?php include_partial('profesional_form', array('form' => $form)) ?>
                    </div>
                </div>
                <div class="bottom"></div>
            </div>
        </div>
    </div>
</div>










<!--<div id="content_concursos_nuevo">


<div class="border-box ML-5">
    <div class="top-left">
        <div class="top-right">
            <h2 style="text-align:center;"><?php //echo '<strong>RECOMIENDA UN NUEVO PROFESIONAL</strong>';    ?></h2>
        </div>
    </div>
    <div class="bottom-left">
        <div class="bottom-right"></div>
    </div>
</div>


<?php //include_partial('profesional_form', array('form' => $form))?>
</div>-->

<script type="text/javascript">
    $('#menu').accordion();
    var get_empresa = function(nombre)
    {
        if(nombre=='') return;

        $.getJSON('/ajax_get/empresa_by_nombre?nombre='+nombre,
        function(data) {
            if(data.retorno=='true'){
                $('#profesional_profesional_tipo_uno_id option[value='+data.sector_1+']').attr("selected",true);

                if(data.sector_2_id!=null){
                    $('option', $('#profesional_profesional_tipo_dos_id')).remove();
                    $.each(data.sector_2, function(index, value) {
                        $('#profesional_profesional_tipo_dos_id').append('<option value="'+index+'">'+value+'</option>');
                        $('#profesional_profesional_tipo_dos_id option[value='+data.sector_2_id+']').attr("selected",true);
                    });
                }
                if(data.sector_3_id!=null){
                    $('option', $('#profesional_profesional_tipo_tres_id')).remove();
                    $.each(data.sector_3, function(index, value) {
                        $('#profesional_profesional_tipo_tres_id').append('<option value="'+index+'">'+value+'</option>');
                        $('#profesional_profesional_tipo_tres_id option[value='+data.sector_3_id+']').attr("selected",true);
                        $('#profesional_profesional_tipo_tres_id').removeAttr("disabled");
                    });
                } else {
                    $('#profesional_profesional_tipo_tres_id').attr('disabled','disabled');
                }
            }
            else{
                $('#profesional_profesional_tipo_uno_id option[value=""]').attr("selected",true);

                $('option', $('#profesional_profesional_tipo_dos_id')).remove();
                $('#profesional_profesional_tipo_dos_id').append('<option value="">Selecciona subsector</option>');
                $('#profesional_profesional_tipo_dos_id option[value=""]').attr("selected",true);

                $('option', $('#profesional_profesional_tipo_tres_id')).remove();
                $('#profesional_profesional_tipo_tres_id').append('<option value="">Selecciona actividad</option>');
                $('#profesional_profesional_tipo_tres_id option[value=""]').attr("selected",true);
            }
        });
    };

    $("#profesional_empresa_nombre").bind('keyup',function() {
        setTimeout(function() {
            $('#profesional_profesional_tipo_uno_id option[value=""]').attr("selected",true);

            $('option', $('#profesional_profesional_tipo_dos_id')).remove();
            $('#profesional_profesional_tipo_dos_id').append('<option value="">Selecciona subsector</option>');
            $('#profesional_profesional_tipo_dos_id option[value=""]').attr("selected",true);

            $('option', $('#profesional_profesional_tipo_tres_id')).remove();
            $('#profesional_profesional_tipo_tres_id').append('<option value="">Selecciona actividad</option>');
            $('#profesional_profesional_tipo_tres_id option[value=""]').attr("selected",true);
        }, 100);
    });

    $("#profesional_profesional_tipo_uno_id").change(function(){
        if ($('#profesional_profesional_tipo_uno_id option:selected').val()>0) {
            reorder_combobox('profesional_profesional_tipo_dos_id', 'ids_ordenados_profesional_profesional_tipo_dos?profesional_tipo_uno_id='+$('#profesional_profesional_tipo_uno_id option:selected').val());
        }
    });

    //desactivamos el combo tres si no tiene valores
    $("#profesional_profesional_tipo_dos_id").change(function(){
        if($('#profesional_profesional_tipo_tres_id option').size()<=1){
            $('#profesional_profesional_tipo_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona actividad</option>');
            $('#profesional_profesional_tipo_tres_id').attr('disabled','disabled');
        }
        else {
            $('#profesional_profesional_tipo_tres_id').removeAttr('disabled');
            if ($('#profesional_profesional_tipo_dos_id option:selected').val()>0) {
                reorder_combobox('profesional_profesional_tipo_tres_id', 'ids_ordenados_profesional_profesional_tipo_tres?profesional_tipo_dos_id='+$('#profesional_profesional_tipo_dos_id option:selected').val());
            }
        }
    });

    function ceuta_melilla(f,g){
        var state2city = new Array();<?php
foreach (StatesTable::getCiudadesAutonomas() as $city)
    printf('state2city[%d]=%d;', $city['states_id'], $city['id'])
    ?>
            if(state2city[f.val()])
                g.val(state2city[f.val()]).attr("disabled","disabled");
        }

        $(document).ready(function() {
            $("#profesional_states_id").change(function(){ ceuta_melilla($(this),$("#profesional_city_id")) });
            $("#profesional").bind("submit",function(){$("#profesional_city_id").removeAttr("disabled");});
            ceuta_melilla($("#profesional_states_id"),$("#profesional_city_id"));

            // reordenamos combos
            if($("#profesional_profesional_tipo_uno_id").length > 0) {
                reorder_combobox('profesional_profesional_tipo_uno_id', 'ids_ordenados_profesional_profesional_tipo_uno');
            }
            if($('#profesional_profesional_tipo_uno_id option:selected').val()>0) {
                reorder_combobox('profesional_profesional_tipo_dos_id', 'ids_ordenados_profesional_profesional_tipo_dos?profesional_tipo_uno_id='+$('#profesional_profesional_tipo_uno_id option:selected').val());
            }
            if($('#profesional_profesional_tipo_dos_id option:selected').val()>0) {
                reorder_combobox('profesional_profesional_tipo_tres_id', 'ids_ordenados_profesional_profesional_tipo_tres?profesional_tipo_dos_id='+$('#profesional_profesional_tipo_dos_id option:selected').val());
            }

            if(($('#profesional_profesional_tipo_dos_id option').size()>1) &&($('#profesional_profesional_tipo_dos_id').val()!='')){
                if($('#profesional_profesional_tipo_tres_id option').size()<=1){
                    $('#profesional_profesional_tipo_tres_id')
                    .find('option')
                    .remove()
                    .end()
                    .append('<option value="">Selecciona actividad</option>');
                    $('#profesional_profesional_tipo_tres_id').attr('disabled','disabled');
                }
            }
            $('#profesional_borrador').bind('click', function(){
                $('#profesional').submit();
            });
        });
</script>