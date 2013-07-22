<?php use_helper('Date', 'Text', 'Concursos', 'mihelper') ?>
<div id="concurso_destacados">
    <div align="left">
        <span class="concurso_titulo_destacado">Concursos Destacados</span>
    </div>
    <?php echo image_tag("img/linea_concursos_destacados.png") ?>
    <?php if (count($destacados) == 0): ?>
        <p>
            Aún no hemos destacado ningun concurso. ¿Crees que alguno se merece estar aquí?<br/> ¡<a href="<?php echo url_for('concurso/new?tipo=' . sfContext::getInstance()->getRequest()->getParameter('tipo', 'empresa')) ?>">crea un concurso</a>!
        </p>
    <?php endif; ?>
    <?php foreach ($destacados as $destacado): ?>
        <div id="Bocadillo_<?php echo $destacado->getId() ?>" class="bocadillo_destacados" style="display:none">
            <div class="close" style="margin:5px"></div>
            <div class="inner">
                <p><label class="bundle">Descripción de la incidencia</label><br/>
                    <?php echo truncate_text(html_entity_decode($destacado->getIncidencia()), $length = 680) ?></p>
                <div style="text-align:right">
                    <?php
                    $n = 1;
                    $tmp = 'i' . $destacado->getId() . '_' . $n;
                    $link = link_to(__('ver +'), url_for_plan_accion($destacado, true), array('title' => ($tipo == 'index') ? 'Ver concurso de ideas' : 'Ver detalle del concurso destacado', 'popup' => array('popupWindow', 'width=650,height=500,scrollbars=1,left=200,top=0')));
                    print $link . javascript_tag("$('#$tmp').fancybox({autoSize: true,type:'iframe'});");
                    ?>
                </div>

                <div id="contribuciones">
                    <?php
                    $n_contribuciones = max(0, count($destacado->getContribucionesActivas()) - 1);
                    $text = format_number_choice('[0]0 contribuciones|[1]1 contribución|(1,+Inf]%count% contribuciones', array('%count%' => $n_contribuciones), $n_contribuciones);
                    print link_to($text, url_for_concurso($destacado), array('title' => 'Ver contribuciones del concurso'));
                    ?>
                </div>


                <span class="box_right_contribuye_dos"><?php print link_to_concurso($destacado) ?></span>
                <script>
                    $('#Bocadillo_<?php echo $destacado->getId() ?> .close').click(function(){$('#Bocadillo_<?php echo $destacado->getId() ?>').fadeOut();bocadillo = [];});
                </script>
            </div>
        </div>
        <div id="enumera_concurso_destacado">
            <div id="fondo_destacado_top"></div>
            <div id="fondo_destacado_mid">
                <div class="c_destacado_titulo">
                    <?php print link_to(truncate_text($destacado->name, $length = 50), url_for_concurso($destacado)) ?>
                </div>
                <hr>
                <div class="fecha">
                    <?php echo format_datetime($destacado->created_at, "p", "es_ES") ?>
                </div>
                <div class="estado" style="float: right;">
                    <?php echo $destacado->getConcursoEstado()->getName() ?>
                </div>
                <?php if ($destacado->concurso_tipo_id == 1): ?>
                    <!-- Empresa -->
                    <div class="nombre">
                        <?php echo ($destacado->Empresa ? $destacado->Empresa->name : ''); ?>
                    </div>
                    <div class="provincia">
                        <?php echo $destacado->getCityandState() ?>
                    </div>
                <?php else: ?>
                    <?php if ($destacado->empresa_id == null): ?>
                        <div class="c_oncurso_nombre">
                            <?php echo ($destacado->Producto ? $destacado->Producto->name : ''); ?>
                        </div>
                        <div class="c_oncurso_marca">
                            <?php echo ($destacado->Producto ? $destacado->Producto->marca : ''); ?>
                        </div>
                        <div class="c_oncurso_modelo">
                            <?php echo ($destacado->Producto ? $destacado->Producto->modelo : ''); ?>
                        </div>
                    <?php
                    endif;
                endif;
                ?>
                <div class="creado_por">
                    <?php
                    if (($sf_user->isAuthenticated()) && ($destacado->getUserId() == $sf_user->getGuardUser()->getId()))
                        echo __('Creado por ti');
                    else
                        echo __('Creado por: %%username%%', array('%%username%%' => $destacado->getUser()->getUserName()));
                    ?>
                </div>
                <div id="contribuciones">
                    <?php
                    $n_contribuciones = max(0, count($destacado->getContribucionesActivas()) - 1);
                    $text = format_number_choice('[0]0 contribuciones|[1]1 contribución|(1,+Inf]%count% contribuciones', array('%count%' => $n_contribuciones), $n_contribuciones);
                    print link_to($text, url_for_concurso($destacado), array('title' => 'Ver contribuciones del concurso'));
                    ?>
                </div>
                <div class="boton_vota_<?php echo $destacado->getId() ?>">
    <?php echo link_to_function('ver +', 'return false;', array('title' => 'Ver concurso destacado')) ?>
                </div>
                <script>
                    $('.boton_vota_<?php echo $destacado->getId() ?>').click(function(e){
                        muestra_bocadillo(e,<?php echo $destacado->getId() ?>);
                    });
                </script>
            </div>
            <div id="fondo_destacado_bot"></div>
        </div>
<?php endforeach; ?>
</div>

<script>
    var bocadillo = new Array();
    var muestra_bocadillo = function(e,id)
    {
        var pos = $('.boton_vota_'+id).position();

        $('#Bocadillo_'+id).css('left',(pos.left+100)+'px');
        $('#Bocadillo_'+id).css('top',(pos.top-$('#Bocadillo_'+id).height())+'px');

        if(bocadillo[id]){
            $('.bocadillo_destacados').fadeOut();
            bocadillo = [];
        }
        else{
            $('.bocadillo_destacados').fadeOut();
            $('#Bocadillo_'+id).fadeIn();
            bocadillo[id]=true;
        }
    };
</script>