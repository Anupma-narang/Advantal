<?php use_javascript('jquery.autocompleter.js') ?>
<?php use_stylesheet('jquery.autocompleter.css') ?>

<form id="filterForm" action="<?php print $url ?>" method="POST">
<?php echo $form->renderHiddenFields() ?>
<input type="hidden" id="filterForm_advanced" name="advanced" value="<?php print $advanced ?>" />
<input type="hidden" id="filterForm_page" name="page" value="<?php print $pager->getPage(); ?>">
<input type="hidden" id="filterForm_extraField" name="extra" value="">
<div class="border-box searchform">
    <div class="top-left"><div class="top-right">
        <table>
            <tr>
                <th><?php echo $form['producto']->renderLabel() ?></th>
                <th><?php echo $form['marca']->renderLabel() ?></th>
                <th><?php echo $form['modelo']->renderLabel() ?></th>
            </tr>
            <tr>
                <td><?php echo $form['producto']->render() ?></td>
                <td><?php echo $form['marca']->render() ?></td>
                <td><?php echo $form['modelo']->render() ?></td>
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
            <a id="toggleNormalAdv" href="#" title="Búsqueda avanzada de concursos de Producto">&nbsp;</a>
            &nbsp;|&nbsp;
            <a class="resetForm" href="#" title="Nueva búsqueda de concursos de Producto"><?php print __('nueva búsqueda') ?></a>
            <input type="submit" value="buscar" id="Submit" title="Buscar concursos de ideas de Producto">
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
            <strong><?php print __('Criterios de ordenación/filtrado') ?></strong>
            <table width="100%">
                <tr>
                    <td><?php echo $form['filter_option']->render() ?></td>
                    <td><?php echo $form['filter_marca']->render() ?></td>
                    <td><?php echo $form['filter_modelo']->render() ?></td>
                    <!--<td width="100%" align="right"><input type="submit" value="buscar"></td>-->
                    <td width="100%" align="right" style="visibility:hidden;" id="tdBotonOrdena"><input type="button" value="Ordena" onclick="onChangeField()"></td>
                </tr>
            </table>
            <div class="totheright">
                <a id="save_link" href="#" title="Vuelve a mi orden predeterminado de concursos">recuerda orden</a>
                -
                <a id="restore_link" href="#" title="Establece como predeterminado este orden de concursos">Mi orden</a>
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
    $("#toggleNormalAdv").click(function(){toggleAdvancedSearch();return false;});

    $("#ConcursoProductoSearchForm_producto").autocomplete("<?php echo url_for('ajax_get/productos_by_nombre')?>", {width: 260, selectFirst: false});
    $("#ConcursoProductoSearchForm_marca").autocomplete("<?php echo url_for('ajax_get/productos_by_marca')?>", {width: 260, selectFirst: false});
    $("#ConcursoProductoSearchForm_modelo").autocomplete("<?php echo url_for('ajax_get/productos_by_modelo')?>", {width: 260, selectFirst: false});
    $("#ConcursoProductoSearchForm_autor").autocomplete("<?php echo url_for('ajax_get/sfguarduser_by_nombre') ?>", {width: 260, selectFirst: false });
    $("#ConcursoProductoSearchForm_filter_marca").autocomplete("<?php echo url_for('ajax_get/productos_by_marca')?>", {width: 260,selectFirst: false});
    $("#ConcursoProductoSearchForm_filter_modelo").autocomplete("<?php echo url_for('ajax_get/productos_by_modelo')?>", {width: 260,selectFirst: false});
    $("#save_link").click(function(){$("#filterForm_extraField").val("save");$("#filterForm").submit();});
    $("#restore_link").click(function(){$("#filterForm_extraField").val("restore");$("#filterForm").submit();});
    $("a.resetForm").click(onResetForm);
    $('input[type="submit"]').click(function(){$("#filterForm_page").val(1);});

    sync_fields("CompleteForm");
    showHideFilterFields();
    enableEventHandlers();
});

var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

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

function toggleAdvancedSearch(){
    showHideAdvancedSearch($("#advanced_searchform").is(":visible")?'hide':'show');
    $("#ConcursoProductoSearchForm_estado_id").val("");
    $("#ConcursoProductoSearchForm_autor").val("");
    $("#ConcursoProductoSearchForm_n_participantes").val("");
}

function enableEventHandlers(){
    $("#ConcursoProductoSearchForm_filter_option").bind('change', onChangeFilterOption);
    $("#ConcursoProductoSearchForm_concurso_categoria_id").bind('change', onChangeCategoriaBox);
    /*$("#ConcursoProductoSearchForm_marca").bind('result', onChangeField);
    $("#ConcursoProductoSearchForm_modelo").bind('result', onChangeField);*/
    /*$("#ConcursoProductoSearchForm_filter_marca").bind('result', onChangeField);
    $("#ConcursoProductoSearchForm_filter_marca").keyup(function(e) { if (this.value==''){ onChangeField(e); } });
    $("#ConcursoProductoSearchForm_filter_modelo").bind('result', onChangeField);
    $("#ConcursoProductoSearchForm_filter_modelo").keyup(function(e) { if (this.value==''){ onChangeField(e); } });*/
}
function disableEventHandlers(){
    $("#ConcursoProductoSearchForm_concurso_categoria_id").unbind('change', onChangeCategoriaBox);
    $("#ConcursoProductoSearchForm_filter_option").unbind('change', onChangeFilterOption);
    /*$("#ConcursoProductoSearchForm_marca").unbind('result', onChangeField);
    $("#ConcursoProductoSearchForm_modelo").unbind('result', onChangeField);*/
    /*$("#ConcursoProductoSearchForm_filter_marca").unbind('result', onChangeField);
    $("#ConcursoProductoSearchForm_filter_modelo").unbind('result', onChangeField);*/
}

function onChangeCategoriaBox(){
    disableEventHandlers();
    $("#ConcursoProductoSearchForm_filter_option").val(13);
    showHideFilterFields();
    enableEventHandlers();
    return false;
}

function onChangeFilterOption(){
    disableEventHandlers();
    resetForm($("#ConcursoProductoSearchForm_filter_option").val());
    enableEventHandlers();
    //submitFormOnChangeFilterOption();
}

function onChangeField(){
    disableEventHandlers();
    if ($("ConcursoProductoSearchForm_filter_marca").val()!='') {
        sync_fields("ConcursoProductoSearchForm_filter_marca");
    }
    if ($("ConcursoProductoSearchForm_filter_modelo").val()!='') {
        sync_fields("ConcursoProductoSearchForm_filter_modelo");
    }
    enableEventHandlers();
    submitFormOnChangeFilterOption();
}

function submitFormOnChangeFilterOption(){
    $("#filterForm").submit();
}

function onResetForm(e){
    disableEventHandlers();
    resetForm(11);
    enableEventHandlers();
    submitFormOnChangeFilterOption();
    return false;
}

function resetForm(f){
    $("#filterForm").find(":input").each(function(){if(!$(this).is(":submit") && $(this).attr("id")!="filterForm_advanced" && $(this).attr("id")!="filterForm_page") $(this).val("");});
    sync_fields("onChangeConcursoProductoSearchForm_Fieldstates_id");
    $("#ConcursoProductoSearchForm_filter_option").val(f);
    showHideFilterFields();
}

function showHideFilterFields(){
    if ( 15 == $("#ConcursoProductoSearchForm_filter_option").val()) {
        $("#ConcursoProductoSearchForm_filter_marca").css("visibility", "visible");
        $("#ConcursoProductoSearchForm_filter_modelo").css("visibility", "hidden");
        $("#tdBotonOrdena").css("visibility", "visible");
    } else if ( 16 == $("#ConcursoProductoSearchForm_filter_option").val()) {
        $("#ConcursoProductoSearchForm_filter_marca").css("visibility", "visible");
        $("#ConcursoProductoSearchForm_filter_modelo").css("visibility", "visible");
        $("#tdBotonOrdena").css("visibility", "visible");
    } else {
        $("#ConcursoProductoSearchForm_filter_marca").css("visibility", "hidden");
        $("#ConcursoProductoSearchForm_filter_modelo").css("visibility", "hidden");
        $("#tdBotonOrdena").css("visibility", "hidden");
    }
}

function sync_fields(field){
    switch(field){
        case "ConcursoProductoSearchForm_marca":
        case "ConcursoProductoSearchForm_modelo":
            marca=$("#ConcursoProductoSearchForm_marca").val();
            $("#ConcursoProductoSearchForm_filter_marca").val(marca);
            if(field=="ConcursoProductoSearchForm_modelo" || marca != "") $("#ConcursoProductoSearchForm_filter_marca").css("visibility", "visible");
            if (field=="ConcursoProductoSearchForm_modelo") {
                modelo=$("#ConcursoProductoSearchForm_modelo").val();
                $("#ConcursoProductoSearchForm_filter_modelo").val(modelo);
                if(modelo != "") $("#ConcursoProductoSearchForm_filter_modelo").css("visibility", "visible");
            }
            if (marca!="" || modelo!="") $("#ConcursoProductoSearchForm_filter_option").val($("#ConcursoProductoSearchForm_filter_modelo").css("visibility")=="visible"?16:15);
            break;

        case "ConcursoProductoSearchForm_filter_marca":
            $("#ConcursoProductoSearchForm_marca").val($("#ConcursoProductoSearchForm_filter_marca").val());
            break;
        case "ConcursoProductoSearchForm_filter_modelo":
            $("#ConcursoProductoSearchForm_modelo").val($("#ConcursoProductoSearchForm_filter_modelo").val());
            break;
    }
}
</script>
