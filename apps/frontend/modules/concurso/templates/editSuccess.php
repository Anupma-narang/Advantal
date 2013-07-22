<?php use_stylesheet('forms.css') ?>
<?php use_stylesheet('caja.css') ?>
<?php use_javascript('reorder_combobox.js') ?>
<div id="content_concursos_nuevo">
    <div id="concurso_crear">
        <div id="concurso_crear_texto">Editar concurso</div>
    </div>

    <?php include_partial('concurso_form', array('form' => $form, 'tipo' => $tipo, 'from' => $from)) ?>
</div>
<script>
<?php if ($id): ?>
    <?php if ($tipo == 'empresa'): ?>
        <?php if ($empresa = Doctrine::getTable('Empresa')->createQuery()->where('id=?', $id)->fetchOne()): ?>
                                $(document).ready(function() {
                                    setTimeout(function() {
                                        $('#concurso_empresa_nombre').val('<?php echo $empresa->getName() ?>');
                                    }, 50);
                                    $('#concurso_empresa_sector_uno_id').val('<?php echo $empresa->getEmpresaSectorUnoId() ?>');
                                    $('option', $('#concurso_empresa_sector_dos_id')).remove();
                                    $('#concurso_empresa_sector_dos_id').append(new Option('<?php echo $empresa->getEmpresaSectorDos()->getName() ?>', 1, true, true));
                                    $('option', $('#concurso_empresa_sector_tres_id')).remove();
                                    $('#concurso_empresa_sector_tres_id').append(new Option('<?php echo $empresa->getEmpresaSectorTres()->getName() ?>', 1, true, true));
                                    if($('#concurso_empresa_sector_tres_id option').size()<=1){
                                        $('#concurso_empresa_sector_tres_id')
                                        .find('option')
                                        .remove()
                                        .end()
                                        .append('<option value="">Selecciona actividad</option>');
                                        $('#concurso_empresa_sector_tres_id').attr('disabled','disabled');
                                    }
                                });
        <?php endif; ?>
    <?php elseif ($tipo == 'producto'): ?>
        <?php if ($producto = Doctrine::getTable('Producto')->createQuery()->where('id=?', $id)->fetchOne()): ?>
                                $(document).ready(function() {
                                    setTimeout(function() {
                                        $('#concurso_producto_nombre').val('<?php echo $producto->getMarca() ?>');
                                    }, 50)
                                    $('#concurso_producto').val('<?php echo $producto->getName() ?>');
                                    $('#concurso_modelo').val('<?php echo $producto->getModelo() ?>');
                                    $('#concurso_producto_tipo_uno_id').val('<?php echo $producto->getProductoTipoUnoId() ?>');
                                    $('option', $('#concurso_producto_tipo_dos_id')).remove();
                                    $('#concurso_producto_tipo_dos_id').append(new Option('<?php echo $producto->getProductoTipoDos()->getName() ?>', 1, true, true));
                                    $('option', $('#concurso_producto_tipo_tres_id')).remove();
                                    $('#concurso_producto_tipo_tres_id').append(new Option('<?php echo $producto->getProductoTipoTres()->getName() ?>', 1, true, true));								
                                });		
        <?php endif; ?>			
    <?php endif; ?>
<?php endif; ?>
		
    var get_empresa = function(nombre)
    {
        $.getJSON('/ajax_get/empresa_by_nombre?nombre='+nombre,				           
        function(data) {
            if(data.retorno=='true'){
                $('#concurso_empresa_sector_uno_id option[value='+data.sector_1+']').attr("selected",true);						
						
                if(data.sector_2_id!=null){
                    $('option', $('#concurso_empresa_sector_dos_id')).remove();
                    $.each(data.sector_2, function(index, value) {							
                        $('#concurso_empresa_sector_dos_id').append('<option value="'+index+'">'+value+'</option>');
                        $('#concurso_empresa_sector_dos_id option[value='+data.sector_2_id+']').attr("selected",true);															
                    });							
                }						
                if(data.sector_3_id!=null){
                    $('option', $('#concurso_empresa_sector_tres_id')).remove();
                    $.each(data.sector_3, function(index, value) {							
                        $('#concurso_empresa_sector_tres_id').append('<option value="'+index+'">'+value+'</option>');
                        $('#concurso_empresa_sector_tres_id option[value='+data.sector_3_id+']').attr("selected",true);															
                    });													
                }
            }
            else{
                $('#concurso_empresa_sector_uno_id option[value=""]').attr("selected",true);						
						
                $('option', $('#concurso_empresa_sector_dos_id')).remove();
                $('#concurso_empresa_sector_dos_id').append('<option value="">Selecciona subsector</option>');
                $('#concurso_empresa_sector_dos_id option[value=""]').attr("selected",true);

                $('option', $('#concurso_empresa_sector_tres_id')).remove();						
                $('#concurso_empresa_sector_tres_id').append('<option value="">Selecciona actividad</option>');
                $('#concurso_empresa_sector_tres_id option[value=""]').attr("selected",true);
            }
        });							
    };	
    var get_producto = function(marca, nombre)
    {
        $.getJSON('/ajax_get/producto_by_marca_and_nombre?marca='+marca+'&nombre='+nombre,
        function(data) {
            if(data.retorno=='true'){
                $('#concurso_producto').val(data.nombre);
                $('#concurso_producto_nombre').val(data.marca);
                $('#concurso_modelo').val(data.modelo);
                $('#concurso_producto_tipo_uno_id option[value='+data.tipo_1+']').attr("selected",true);
						
                if(data.tipo_2_id!=null){						
                    $('option', $('#concurso_producto_tipo_dos_id')).remove();
                    $.each(data.tipo_2, function(index, value) {							
                        $('#concurso_producto_tipo_dos_id').append('<option value="'+index+'">'+value+'</option>');
                        $('#concurso_producto_tipo_dos_id option[value='+data.tipo_2_id+']').attr("selected",true);															
                    });
															
                }
                if(data.tipo_3_id!=null){
                    $('option', $('#concurso_producto_tipo_tres_id')).remove();
                    $.each(data.tipo_3, function(index, value) {							
                        $('#concurso_producto_tipo_tres_id').append('<option value="'+index+'">'+value+'</option>');
                        $('#concurso_producto_tipo_tres_id option[value='+data.tipo_3_id+']').attr("selected",true);															
                    });
                }
            }
            else{
                $('#concurso_producto_tipo_uno_id option[value=""]').attr("selected",true);

                $('option', $('#concurso_producto_tipo_dos_id')).remove();
                $('#concurso_producto_tipo_dos_id').append('<option value="">Selecciona subsector</option>');
                $('#concurso_producto_tipo_dos_id option[value=""]').attr("selected",true);

                $('option', $('#concurso_producto_tipo_tres_id')).remove();						
                $('#concurso_producto_tipo_tres_id').append('<option value="">Selecciona tipo</option>');
                $('#concurso_producto_tipo_tres_id option[value=""]').attr("selected",true);
            }
        });							
    };	

    $("#concurso_empresa_nombre").autocomplete("<?php echo url_for('/autocomplete') ?>", 
    jQuery.extend({}, {
        dataType: 'json',
        parse: function(data) {
            var parsed = [];
            for (key in data) {
                parsed[parsed.length] = { data: [ data[key], key ], value: data[key], result: data[key] };
            }
            return parsed;
        },
    }, { })).result(function(event, data) { get_empresa(data[0]); });	
    $("#concurso_empresa_nombre").bind('keyup',function() {
        setTimeout(function() {
            if($("#concurso_empresa_nombre").val()!='')			
                get_empresa($("#concurso_empresa_nombre").val());	
        }, 100);
    });

    $("#concurso_producto_nombre").autocomplete("<?php echo url_for('/complete') ?>", 
    jQuery.extend({}, {
        dataType: 'json',
        parse: function(data) {
            var parsed = [];
            for (key in data) {
                parsed[parsed.length] = { data: [ data[key], key ], value: data[key], result: data[key] };
            }
            return parsed;
        },
    }, { })).result(function(event, data) { get_producto(data[0]); });		
    $("#concurso_producto_nombre").bind('keyup',function() {
        setTimeout(function() {
            if($("#concurso_producto_nombre").val()!='')
                get_producto($("#concurso_producto_nombre").val());
        }, 100);
    });
	
    $("#concurso_producto").autocomplete("<?php echo url_for('concurso/completeNombreProducto') ?>",
    jQuery.extend({}, {
        dataType: 'json',
        parse: function(data) {
            var parsed = [];
            for (key in data) {
                parsed[parsed.length] = { data: [ data[key], key ], value: data[key], result: data[key] };
            }
            return parsed;
        },
    }, { })).result(function(event, data) { get_producto($("#concurso_producto_nombre").val(), data[0]); });
    $("#concurso_producto").bind('keyup',function() {
        setTimeout(function() {
            if($("#concurso_producto").val()!='')
                get_producto('', $("#concurso_producto").val());
        }, 100);
    });
	
    $("#concurso_empresa_sector_uno_id").change(function(){
        if ($('#concurso_empresa_sector_uno_id option:selected').val()>0) {
            reorder_combobox('concurso_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id='+$('#concurso_empresa_sector_uno_id option:selected').val());
        }
    });
	
    //desactivamos el combo tres si no tiene valores
    $("#concurso_empresa_sector_dos_id").change(function(){
        if($('#concurso_empresa_sector_tres_id option').size()<=1){
            $('#concurso_empresa_sector_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona actividad</option>');			
            $('#concurso_empresa_sector_tres_id').attr('disabled','disabled');
        }
        else {
            $('#concurso_empresa_sector_tres_id').removeAttr('disabled');
            if ($('#concurso_empresa_sector_dos_id option:selected').val()>0) {
                reorder_combobox('concurso_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id='+$('#concurso_empresa_sector_dos_id option:selected').val());
            }
        }
    });
	
    $("#concurso_producto_tipo_uno_id").change(function(){
        if ($('#concurso_producto_tipo_uno_id option:selected').val()>0) {
            reorder_combobox('concurso_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id='+$('#concurso_producto_tipo_uno_id option:selected').val());
        }
    });
	
    $("#concurso_producto_tipo_dos_id").change(function(){
        if($('#concurso_producto_tipo_tres_id option').size()<=1){
            $('#concurso_producto_tipo_tres_id')
            .find('option')
            .remove()
            .end()
            .append('<option value="">Selecciona subsector</option>');			
            $('#concurso_producto_tipo_tres_id').attr('disabled','disabled');
        }
        else {
            $('#concurso_producto_tipo_tres_id').removeAttr('disabled');
            if ($('#concurso_producto_tipo_dos_id option:selected').val()>0) {
                reorder_combobox('concurso_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id='+$('#concurso_producto_tipo_dos_id option:selected').val());
            }
        }
    });  	 
	
    $("#concurso_states_id").change(function(){
        if($(this).val()==1){
            setTimeout(function() {	//todas
                $("#concurso_city_id option[value=8113]").attr("selected",true);	//todas
                $("#concurso_city_id").attr("disabled","disabled");
            }, 50);
        }			
        else if($(this).val()==16){	//ceuta
            setTimeout(function() {
                $("#concurso_city_id option[value=5884]").attr("selected",true);	//ceuta
                $("#concurso_city_id").attr("disabled","disabled");
            }, 50);
        }
        else if($(this).val()==35){	//melilla
            setTimeout(function() {
                $("#concurso_city_id option[value=5885]").attr("selected",true);	//	melilla
                $("#concurso_city_id").attr("disabled","disabled");
            }, 50);
        }
    });
    $(document).ready(function() {

        if ($("#concurso_states_id").val()==1){	    	        
            $("#concurso_city_id").attr("disabled","disabled");
            $("#concurso_city_id option[value=8113]").attr("selected", true);
        }
        else if ($("#concurso_states_id").val()==16){	    	        
            $("#concurso_city_id").attr("disabled","disabled");
            $("#concurso_city_id option[value=5884]").attr("selected", true);
        }
        else if ($("#concurso_states_id").val()==35){	    	        
            $("#concurso_city_id").attr("disabled","disabled");
            $("#concurso_city_id option[value=5885]").attr("selected", true);
        }
			
			
        // reordenamos combos
        if ($("#concurso_empresa_sector_uno_id").length > 0) {
            reorder_combobox('concurso_empresa_sector_uno_id', 'ids_ordenados_concurso_empresa_sector_uno');
        }
        if ($('#concurso_empresa_sector_uno_id option:selected').val()>0) {
            reorder_combobox('concurso_empresa_sector_dos_id', 'ids_ordenados_concurso_empresa_sector_dos?empresa_sector_uno_id='+$('#concurso_empresa_sector_uno_id option:selected').val());
        }
        if ($('#concurso_empresa_sector_dos_id option:selected').val()>0) {
            reorder_combobox('concurso_empresa_sector_tres_id', 'ids_ordenados_concurso_empresa_sector_tres?empresa_sector_dos_id='+$('#concurso_empresa_sector_dos_id option:selected').val());
        }
			
        if ($("#concurso_producto_tipo_uno_id").length > 0) {
            reorder_combobox('concurso_producto_tipo_uno_id', 'ids_ordenados_concurso_producto_tipo_uno');
        }
        if ($('#concurso_producto_tipo_uno_id option:selected').val()>0) {
            reorder_combobox('concurso_producto_tipo_dos_id', 'ids_ordenados_concurso_producto_tipo_dos?producto_tipo_uno_id='+$('#concurso_producto_tipo_uno_id option:selected').val());
        }
        if ($('#concurso_producto_tipo_dos_id option:selected').val()>0) {
            reorder_combobox('concurso_producto_tipo_tres_id', 'ids_ordenados_concurso_producto_tipo_tres?producto_tipo_dos_id='+$('#concurso_producto_tipo_dos_id option:selected').val());
        }
	    
	    
		
        // vamos a poner el valor del empresa y producto por defecto 
        //		$("#autocomplete_concurso_empresa_nombre").val("<?php echo sfContext::getInstance()->getRequest()->getPostParameter('autocomplete_concurso[empresa_nombre]') ?>");
        //		$("#autocomplete_concurso_producto_id").val("<?php echo sfContext::getInstance()->getRequest()->getPostParameter('autocomplete_concurso[producto_id]') ?>");

        if(($('#concurso_empresa_sector_dos_id option').size()>1) &&($('#concurso_empresa_sector_dos_id').val()!='')){ 
            if($('#concurso_empresa_sector_tres_id option').size()<=1){
                $('#concurso_empresa_sector_tres_id')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Selecciona actividad</option>');			
                $('#concurso_empresa_sector_tres_id').attr('disabled','disabled');
            }	
        }
        if(($('#concurso_producto_tipo_dos_id option').size()>1) &&($('#concurso_producto_tipo_dos_id').val()!='')){
            if($('#concurso_producto_tipo_tres_id option').size()<=1){
                $('#concurso_producto_tipo_tres_id')
                .find('option')
                .remove()
                .end()
                .append('<option value="">Selecciona subsector</option>');			
                $('#concurso_producto_tipo_tres_id').attr('disabled','disabled');
            }
        }
    });
</script>