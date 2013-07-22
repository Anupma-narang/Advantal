<?php use_javascript('jquery.autocompleter.js') ?>
<?php use_stylesheet('jquery.autocompleter.css') ?>

<form id="filterForm" action="<?php //print $url ?>" method="POST">
<?php echo $form->renderHiddenFields() ?>
<input type="hidden" id="filterForm_advanced" name="advanced" value="<?php print $advanced ?>" />
<input type="hidden" id="filterForm_page" name="page" value="<?php print $pager->getPage(); ?>">
<input type="hidden" id="filterForm_extraField" name="extra" value="">
<div class="border-box searchform">
    <div class="top-left"><div class="top-right">
        <table>
            <tr>
                <th><?php echo $form['empresa']->renderLabel() ?></th>
                <th><?php echo $form['states_id']->renderLabel() ?></th>
                <th><?php echo $form['city_id']->renderLabel() ?></th>
            </tr>
            <tr>
                <td><?php echo $form['empresa']->render() ?></td>
                <td><?php echo $form['states_id']->render() ?> <img class="ajax_waiting" src="/images/img/ajax.gif"></td>
                <td><?php echo $form['city_id']->render() ?></td>
            </tr>
        </table>
        <table id="advanced_searchform">
            <tr>
                <th><?php echo $form['estado_id']->renderLabel() ?></th>
                <th><?php echo $form['autor']->renderLabel() ?></th>
                <th><?php echo $form['n_participantes']->renderLabel() ?></th>
            </tr>
            <tr>
                <td><?php echo $form['estado_id']->render() ?></td>
                <td><?php echo $form['autor']->render() ?></td>
                <td><?php echo $form['n_participantes']->render() ?></td>
            </tr>
            <tr>
                <th colspan="3"><?php echo $form['concurso_categoria_id']->renderLabel() ?></th>
            </tr>
            <tr>
                <td colspan="3"><?php echo $form['concurso_categoria_id']->render() ?></td>
            </tr>
        </table>

        <div class="totheright">
            <a id="toggleNormalAdv" href="#" title="Búsqueda avanzada de concursos de Empresa y Entidad">&nbsp;</a>
            &nbsp;|&nbsp;
            <a class="resetForm" href="#" title="Nueva búsqueda de concursos de Empresa y Entidad"><?php print __('nueva búsqueda') ?></a>
            <input type="submit" value="buscar" id="Submit" title="Buscar concursos de ideas de Empresa y Entidad">
        </div>
    </div></div><div class="bottom-left"><div class="bottom-right"></div></div>
</div>

<div id="content_titulo_listado">
    <div id="text_titulo_listado"><?php print $text['titulo'] ?></div>
    <div id="text_sumario_listado"><?php print $text['sumario'] ?></div>
</div>

<div class="border-box searchform">
    <div class="top-left">
        <div class="top-right">
            <div>
                <?php print __('Criterios de ordenación/filtrado') ?>:
                <?php echo $form['filter_option']->render() ?>
            </div>
            <div>
                <?php echo $form['filter_states_id']->render() ?>
                <?php echo $form['filter_city_id']->render() ?>
            </div>
            <div class="totheright">
                <a id="save_link" href="#" title="Vuelve a mi orden predeterminado de concursos">recuerda orden</a>
                -
                <a id="restore_link" href="#" title="Establece como predeterminado este orden de concursos">Mi orden</a>
                <!--<input type="submit" value="buscar">-->
            </div>
        </div>
    </div>
    <div class="bottom-left">
            <div class="bottom-right"></div>
    </div>
</div>
</form>
<script type="text/javascript">
$(document).ready(function() {
    showHideAdvancedSearch('<?php print $advanced==0?'hide':'show' ?>');

    // Los combos dependientes no cargan por defecto sus valores al recargar la página. Hay que forzarlos así.
    <?php if ($form->getValue('states_id')>0): ?>
    $("#ConcursoEmpresaSearchForm_states_id").val(<?php echo $form->getValue('states_id') ?>);
    $("#ConcursoEmpresaSearchForm_states_id").change();
    <?php endif ?>
    <?php if ($form->getValue('city_id')>0): ?>
    $("#ConcursoEmpresaSearchForm_city_id").val(<?php echo $form->getValue('city_id') ?>);
    $("#ConcursoEmpresaSearchForm_city_id").change();
    <?php endif ?>

    $("#toggleNormalAdv").click(function(){toggleAdvancedSearch();return false;});
    $("#ConcursoEmpresaSearchForm_empresa").autocomplete("<?php echo url_for('ajax_get/empresas_by_nombre') ?>", {width: 260, selectFirst: false});
    $("#ConcursoEmpresaSearchForm_autor").autocomplete("<?php echo url_for('ajax_get/sfguarduser_by_nombre') ?>", {width: 260, selectFirst: false });
    $("#save_link").click(function(){$("#filterForm_extraField").val("save");$("#filterForm").submit();});
    $("#restore_link").click(function(){$("#filterForm_extraField").val("restore");$("#filterForm").submit();});
    $("a.resetForm").click(onResetForm);
    $('input[type="submit"]').click(function(){$("#filterForm_page").val(1);$("#ConcursoEmpresaSearchForm_city_id").removeAttr("disabled");$("#ConcursoEmpresaSearchForm_filter_city_id").removeAttr("disabled");});
    $("img.ajax_waiting").bind("ajaxSend", function(e, xhr, settings){$(this).css("visibility", "visible");if (settings.url == "/sfDependentSelectAuto/_ajax") {$("#ConcursoEmpresaSearchForm_filter_city_id").attr("disabled","disabled");}}).bind("ajaxComplete", function(){$(this).css("visibility", "hidden");$("#ConcursoEmpresaSearchForm_filter_city_id").removeAttr("disabled");});

    sync_combos("CompleteForm");
    showHideFilterFields();
    enableEventHandlers();
});

function enableEventHandlers(){
    $("#ConcursoEmpresaSearchForm_filter_option").bind('change', onChangeFilterOption);
    $("#ConcursoEmpresaSearchForm_concurso_categoria_id").bind('change', onChangeCategoriaBox);
    $("#ConcursoEmpresaSearchForm_states_id").bind('change', onChangeDependentCombos);
    $("#ConcursoEmpresaSearchForm_city_id").bind('change', onChangeDependentCombos);
    $("#ConcursoEmpresaSearchForm_filter_states_id").bind('change', onChangeDependentCombos);
    $("#ConcursoEmpresaSearchForm_filter_city_id").bind('change', onChangeDependentCombos);
}

function disableEventHandlers(){
    $("#ConcursoEmpresaSearchForm_filter_option").unbind('change', onChangeFilterOption);
    $("#ConcursoEmpresaSearchForm_concurso_categoria_id").unbind('change', onChangeCategoriaBox);
    $("#ConcursoEmpresaSearchForm_states_id").unbind('change', onChangeDependentCombos);
    $("#ConcursoEmpresaSearchForm_city_id").unbind('change', onChangeDependentCombos);
    $("#ConcursoEmpresaSearchForm_filter_states_id").unbind('change', onChangeDependentCombos);
    $("#ConcursoEmpresaSearchForm_filter_city_id").unbind('change', onChangeDependentCombos);
}

function toggleAdvancedSearch(){
    showHideAdvancedSearch($("#advanced_searchform").is(":visible")?'hide':'show');
    $("#ConcursoEmpresaSearchForm_estado_id").val("");
    $("#ConcursoEmpresaSearchForm_autor").val("");
    $("#ConcursoEmpresaSearchForm_n_participantes").val("");
}

function showHideAdvancedSearch(op){
    if(op=='hide'){
        $("#advanced_searchform").hide();
        $("#toggleNormalAdv").text('<?php print __('Búsqueda avanzada'); ?>');
        $("#filterForm_advanced").val(0);
    } else if (op=='show') {
        $("#advanced_searchform").show();
        $("#toggleNormalAdv").text('<?php print __('Búsqueda simple'); ?>');
        $("#filterForm_advanced").val(1);
    }
}

function showHideFilterFields(){
    if ( 5 == $("#ConcursoEmpresaSearchForm_filter_option").val()) {
        $("#ConcursoEmpresaSearchForm_filter_states_id").css("visibility", "visible");
        $("#ConcursoEmpresaSearchForm_filter_city_id").css("visibility", "hidden");
    } else if ( 6 == $("#ConcursoEmpresaSearchForm_filter_option").val()) {
        $("#ConcursoEmpresaSearchForm_filter_states_id").css("visibility", "visible");
        $("#ConcursoEmpresaSearchForm_filter_city_id").css("visibility", "visible");
    } else {
        $("#ConcursoEmpresaSearchForm_filter_states_id").css("visibility", "hidden");
        $("#ConcursoEmpresaSearchForm_filter_city_id").css("visibility", "hidden");
    }
}

function onChangeCategoriaBox(){
    disableEventHandlers();
    $("#ConcursoEmpresaSearchForm_filter_option").val(3);
    showHideFilterFields();
    enableEventHandlers();
    return false;
}

function onChangeFilterOption(){
    disableEventHandlers();
    resetForm($("#ConcursoEmpresaSearchForm_filter_option").val());
    enableEventHandlers();
    //submitFormOnChangeFilterOption();
}

function onChangeDependentCombos(e){
    disableEventHandlers();
    sync_combos(e.target.id);
    enableEventHandlers();
    //submitFormOnChangeFilterOption();
}

function submitFormOnChangeFilterOption(){
    //$("#filterForm_page").val(1);
    $("#filterForm").submit();
}

function onResetForm(e){
    disableEventHandlers();
    resetForm(1);
    enableEventHandlers();
    $('#filterForm').submit();
    return false;
}

function resetForm(f){
    $("#filterForm").find(":input").each(function(){if(!$(this).is(":submit") && $(this).attr("id")!="filterForm_advanced" && $(this).attr("id")!="filterForm_page") $(this).val("");});
    $("#ConcursoEmpresaSearchForm_states_id").val(0).change();
    sync_combos("ConcursoEmpresaSearchForm_states_id");
    $("#ConcursoEmpresaSearchForm_filter_option").val(f);
    showHideFilterFields();
}

function sync_combos(field){
    var state2city = new Array();
    <?php foreach (StatesTable::getCiudadesAutonomas() as $city) printf('state2city[%d]=%d;', $city['states_id'], $city['id']) ?>

    switch(field){
        case "ConcursoEmpresaSearchForm_states_id":
        case "ConcursoEmpresaSearchForm_city_id":
        case "CompleteForm":
            if (field=="ConcursoEmpresaSearchForm_states_id" || field=="CompleteForm") {
              if(field=="ConcursoEmpresaSearchForm_states_id"){
                $('#ConcursoEmpresaSearchForm_filter_option').val(5);
              }
              if(field=="ConcursoEmpresaSearchForm_city_id"){
                $('#ConcursoEmpresaSearchForm_filter_option').val(6);
              }
                if(field=="ConcursoEmpresaSearchForm_states_id" || (field=="CompleteForm" && $("#ConcursoEmpresaSearchForm_filter_option").val()>=5))
                    $("#ConcursoEmpresaSearchForm_filter_states_id").css("visibility", "visible");

                state=$("#ConcursoEmpresaSearchForm_states_id").val();
                $("#ConcursoEmpresaSearchForm_filter_states_id").val(state);
                $("#ConcursoEmpresaSearchForm_filter_city_id").empty();
                $("#ConcursoEmpresaSearchForm_city_id option").clone().appendTo("#ConcursoEmpresaSearchForm_filter_city_id");

                if (state2city[state]){ // Si es una ciudad autónoma...
                    $("#ConcursoEmpresaSearchForm_city_id").attr("disabled","disabled");
                    $("#ConcursoEmpresaSearchForm_city_id").val(state2city[state]);
                    $("#ConcursoEmpresaSearchForm_filter_city_id").attr("disabled","disabled");
                    $("#ConcursoEmpresaSearchForm_filter_city_id").val(state2city[state]);
                } else {
                    $("#ConcursoEmpresaSearchForm_city_id").removeAttr('disabled');
                    $("#ConcursoEmpresaSearchForm_filter_city_id").removeAttr('disabled');
                }

                if (field=="CompleteForm" && $("#ConcursoEmpresaSearchForm_filter_option").val()>=5){
                    $("#ConcursoEmpresaSearchForm_filter_city_id").css("visibility", "visible");
                    $("#ConcursoEmpresaSearchForm_filter_city_id").val($("#ConcursoEmpresaSearchForm_city_id").val());
                }
            }
            if (field=="ConcursoEmpresaSearchForm_city_id") {
                $("#ConcursoEmpresaSearchForm_filter_city_id").css("visibility", "visible");
                $("#ConcursoEmpresaSearchForm_filter_city_id").val($("#ConcursoEmpresaSearchForm_city_id").val());
            }

            /*if (field!="CompleteForm" || $("#ConcursoEmpresaSearchForm_filter_option").val()>=5) {
                $("#ConcursoEmpresaSearchForm_filter_option").val($("#ConcursoEmpresaSearchForm_filter_city_id").css("visibility")=="visible"?6:5);
            }*/
            break;
        case "ConcursoEmpresaSearchForm_filter_states_id":
            $("#ConcursoEmpresaSearchForm_states_id").val($("#ConcursoEmpresaSearchForm_filter_states_id").val()).change();
            sync_combos("ConcursoEmpresaSearchForm_states_id");
            break;
        case "ConcursoEmpresaSearchForm_filter_city_id":
            $("#ConcursoEmpresaSearchForm_city_id").val($("#ConcursoEmpresaSearchForm_filter_city_id").val());
            break;
    }
}
</script>
