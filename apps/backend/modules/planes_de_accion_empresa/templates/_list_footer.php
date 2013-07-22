<script>
    $("#contribucion_filters_empresa_sector_dos_id").change(function(){
        if($('#contribucion_filters_empresa_sector_tres_id option').size()<=1){
            $('#contribucion_filters_empresa_sector_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona actividad</option>');
            $('#contribucion_filters_empresa_sector_tres_id').attr('disabled','disabled');
        }
        else {
            $('#contribucion_filters_empresa_sector_tres_id').removeAttr('disabled');
            if ($('#contribucion_filters_empresa_sector_dos_id option:selected').val()>0) {
                reorder_combobox('contribucion_filters_empresa_sector_tres_id', 'ids_ordenados_contribucion_filters_empresa_sector_tres?empresa_sector_dos_id='+$('#contribucion_filters_empresa_sector_dos_id option:selected').val());
            }
        }
    });

    function ceuta_melilla(f,g){
        var state2city = new Array();<?php foreach (StatesTable::getCiudadesAutonomas() as $city)
    printf('state2city[%d]=%d;', $city['states_id'], $city['id']) ?>
        if(state2city[f.val()])
            g.val(state2city[f.val()]).attr("disabled","disabled");
    }
    $(document).ready(function() {
        $("#contribucion_filters_states_id").change(function(){ ceuta_melilla($(this),$("#contribucion_filters_localidad_id")) });
        //$("#frmProfesional").bind("submit",function(){$("#contribucion_filters_localidad_id").removeAttr("disabled");});
        ceuta_melilla($("#contribucion_filters_states_id"),$("#contribucion_filters_localidad_id"));});
</script>