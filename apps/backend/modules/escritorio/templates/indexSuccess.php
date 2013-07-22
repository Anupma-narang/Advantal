<div id="admin_container">
    <h1>Escritorio</h1>

    <div class="column" id="column1">

        <div id="Alertas_home" class="dragbox">
          <h2 class="cbl-color">Alertas</h2>

            <div id="Alertas_home_content" class="dragbox-content">
                <div id="Alertas_home_preload"
                     style="text-align:center"><?php echo image_tag('/images/round_preload.gif')?></div>
            </div>
        </div>
        <div id="alertas_de_caja" class="dragbox">
          <h2 class="co-color">Alertas de Caja</h2>

            <div id="alertas_de_caja_content" class="dragbox-content">
                <div id="alertas_de_caja_preload"
                     style="text-align:center"><?php echo image_tag('/images/round_preload.gif')?></div>
            </div>
        </div>
        <div id="alertas_de_canje" class="dragbox">
          <h2 class="co-color">Alertas de canje</h2>

            <div id="alertas_de_canje_content" class="dragbox-content">
                <div id="alertas_de_canje_preload"
                     style="text-align:center"><?php echo image_tag('/images/round_preload.gif')?></div>
            </div>
        </div>
        <div id="Concursos_home" class="dragbox">
          <h2 class="cg-color">Concursos pendientes</h2>

            <div id="Concursos_home_content" class="dragbox-content">
                <div id="Concursos_home_preload"
                     style="text-align:center"><?php echo image_tag('/images/round_preload.gif')?></div>
            </div>
        </div>

        <div id="Profesionales_home" class="dragbox">
          <h2 class="cg-color">Profesionales pendientes</h2>

            <div id="Profesionales_home_content" class="dragbox-content">
                <div id="Profesionales_home_preload"
                     style="text-align:center"><?php echo image_tag('/images/round_preload.gif')?></div>
            </div>
        </div>

        <div id="Cartas_home" class="dragbox">
          <h2 class="cg-color">Cartas pendientes</h2>

            <div id="Cartas_home_content" class="dragbox-content">
                <div id="Cartas_home_preload"
                     style="text-align:center"><?php echo image_tag('/images/round_preload.gif')?></div>
            </div>
        </div>

        <div id="Contribuciones_home" class="dragbox">
          <h2 class="cg-color">Contribuciones pendientes</h2>

            <div id="Contribuciones_home_content" class="dragbox-content">
                <div id="Contribuciones_home_preload"
                     style="text-align:center"><?php echo image_tag('/images/round_preload.gif')?></div>
            </div>
        </div>


        <!-- <div id="Concursos_comunidad_home" class="dragbox">
            <h2>Concursos Comunidad privada pendientes</h2>

            <div class="dragbox-content">
                <ul>
                    <li>No existen datos.</li>
                </ul>
            </div>
        </div> -->


        <div rel="<?php echo url_for('@cuestionario_pendientes?aprobado=0')?>"  class="dragbox">
          <h2 class="cg-color">Auditorías pendientes</h2>

            <div class="dragbox-content autoload">
            </div>
        </div>
    </div>

    <div class="column" id="column2">

        <div id="Concursos_60_home" class="dragbox">
          <h2 class="cb-color">Concursos de 60 días</h2>

            <div id="Concursos60dias_home_content" class="dragbox-content">
                <div id="Concursos60dias_home_preload"
                     style="text-align:center"><?php echo image_tag('/images/round_preload.gif')?></div>
            </div>
        </div>

        <!-- <div id="Concursos_privada_60_home" class="dragbox">
            <h2>Concursos Comunidad privada de 60 días</h2>

            <div class="dragbox-content">
                <ul>
                    <li>No existen datos.</li>
                </ul>
            </div>
        </div> -->

        <div id="Concursos_75_home" class="dragbox">
          <h2 class="cb-color">Concursos de 75 días</h2>

            <div id="Concursos75dias_home_content" class="dragbox-content">
                <div id="Concursos75dias_home_preload"
                     style="text-align:center"><?php echo image_tag('/images/round_preload.gif')?></div>
            </div>
        </div>

        <!-- <div id="Concursos_privada_75_home" class="dragbox">
            <h2>Concursos Comunidad privada de 75 días</h2>

            <div class="dragbox-content">
                <ul>
                    <li>No existen datos.</li>
                </ul>
            </div>
        </div> -->

        <div rel="<?php echo url_for('comentarios_lista_negra_pendientes')?>"  class="dragbox">
          <h2 class="cg-color">Comentarios de lista negra pendientes</h2>

            <div id='' class="dragbox-content autoload">
            </div>
        </div>

    </div>
    <!-- end column2 -->
</div> <!-- end  sf_admin_container-->
<div class="clear"></div>

<script type="text/javascript" >
$(function(){
	$('.dragbox')
	.each(function(){
		$(this).hover(function(){
			$(this).find('h2').addClass('collapse');
		}, function(){
			$(this).find('h2').removeClass('collapse');
		})
		.find('h2').hover(function(){
			$(this).find('.configure').css('visibility', 'visible');
		}, function(){
			$(this).find('.configure').css('visibility', 'hidden');
		})
		.click(function(){
			$(this).siblings('.dragbox-content').toggle('fast');
		})
		.end()
		.find('.configure').css('visibility', 'hidden');
	});
	$('.column').sortable({
		connectWith: '.column',
		handle: 'h2',
		cursor: 'move',
		placeholder: 'placeholder',
		forcePlaceholderSize: true,
		opacity: 0.4,
		stop: function(event, ui){
			$(ui.item).find('h2').click();
			var sortorder='';
			$('.column').each(function(){
				var itemorder=$(this).sortable('toArray');
				var columnId=$(this).attr('id');
				sortorder+=columnId+'='+itemorder.toString()+'&';
			});
			/*Pasar sortorder como variable al servidor usando ajax para guardar el stado*/
		}
	})
	.disableSelection();

        $('.column').sortable({
            connectWith:'.column',
            handle:'h2',
            cursor:'move',
            placeholder:'placeholder',
            forcePlaceholderSize:true,
            opacity:0.4,
            stop:function (event, ui) {
                $(ui.item).find('h2').click();
                var sortorder = '';
                $('.column').each(function () {
                    var itemorder = $(this).sortable('toArray');
                    var columnId = $(this).attr('id');
                    sortorder += columnId + '=' + itemorder.toString() + '&';
                });
                /*Pasar sortorder como variable al servidor usando ajax para guardar el stado*/
            }
        })
            .disableSelection();

        $('#Alertas_home_content').load('<?php echo url_for('escritorio/get_alertas')?>');
        $('#Concursos_home_content').load('<?php echo url_for('escritorio/get_concursos_pendientes')?>');
        $('#Profesionales_home_content').load('<?php echo url_for('escritorio/get_profesionales_pendientes')?>');
        $('#alertas_de_caja_content').load('<?php echo url_for('alertas_de_caja')?>');
        $('#alertas_de_canje_content').load('<?php echo url_for('alertas_de_canje')?>');
        $('#Cartas_home_content').load('<?php echo url_for('escritorio/get_cartas_pendientes')?>');
        $('#Contribuciones_home_content').load('<?php echo url_for('escritorio/get_contribuciones_pendientes')?>');
        $('#Concursos60dias_home_content').load('<?php echo url_for('escritorio/get_concursos60dias')?>');
        $('#Concursos75dias_home_content').load('<?php echo url_for('escritorio/get_concursos75dias')?>');


        $('.autoload').each(function(id, item) {
            $(this).addClass('loader');
            $(this).load($(item).closest('.dragbox').attr('rel'));
            $(this).removeClass('loader');
        });
    });
</script>