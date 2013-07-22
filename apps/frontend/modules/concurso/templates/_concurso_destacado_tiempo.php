<?php use_helper('Concursos') ?>
<div id="Bocadillo_semana_<?php echo $concurso->getId() ?>" class="bocadillo_destacados" style="display:none">
    <div class="close" style="margin:5px"></div>
    <div class="inner">
        <p><label class="bundle">Descripción de la incidencia</label><br/>
            <?php echo truncate_text(html_entity_decode($concurso->getIncidencia()), $length = 180) ?>
        </p>
        <div style="text-align:right">
            <?php print link_to(__('ver +'), url_for_concurso($concurso)) ?>
        </div>
        <p><label class="bundle">Resumen del plan de acción</label><br/>
            <?php echo truncate_text(html_entity_decode($concurso->getContribucionPrincipal()->getResumen()), $length = 180) ?>
        </p>
        <div style="text-align:right">
            <?php print link_to(__('ver +'), url_for_concurso($concurso)) ?>
        </div>

        <?php print link_to_contribuye($concurso) ?>
        <br/>

        <script>
            $('#Bocadillo_semana_<?php echo $concurso->getId() ?> .close').click(function(){$('#Bocadillo_semana_<?php echo $concurso->getId() ?>').fadeOut();bocadillo_semana = []});
        </script>
    </div>
</div>

<div id="fondo_destacado_top"></div>
<div id="fondo_destacado_mid">
    <div class="c_destacado_titulo">
        <?php echo $concurso->name ?>
    </div>
    <hr>
    <div class="fecha">
        <?php echo format_datetime($concurso->created_at, "p", "es_ES") ?>
    </div>
    <div class="estado" style="float: right;">
        <?php echo $concurso->getConcursoEstado()->getName() ?>
    </div>
    <?php if ($concurso->concurso_tipo_id == 1): ?>
        <!-- Empresa -->
        <div class="nombre">
            <?php echo $concurso->Empresa->name; ?>
        </div>
        <div class="provincia">
            <?php echo $concurso->getCityandState() ?>
        </div>
    <?php else: ?>
        <?php if ($concurso->empresa_id == null): ?>
            <div class="c_oncurso_nombre">
                <?php echo $concurso->Producto->name; ?>
            </div>
            <div class="c_oncurso_marca">
                <?php echo $concurso->Producto->marca; ?>
            </div>
            <div class="c_oncurso_modelo">
                <?php echo $concurso->Producto->modelo; ?>
            </div>
        <?php endif;
    endif; ?>
    <div class="creado_por">
        <?php
        if (($sf_user->isAuthenticated()) && ($concurso->getUserId() == $sf_user->getGuardUser()->getId()))
            echo __('Creado por ti');
        else
            echo __('Creado por: %%username%%', array('%%username%%' => $concurso->getUser()->getUserName()));
        ?>
    </div>
    <div id="contribuciones">
        <?php
            $n_contribuciones = max(0, count($concurso->getContribucionesActivas())-1);
            $text = format_number_choice('[0]0 contribuciones|[1]1 contribución|(1,+Inf]%count% contribuciones', array('%count%' => $n_contribuciones), $n_contribuciones);
            print link_to($text, url_for_concurso($concurso));
        ?>
    </div>
    <div id="ver_concurso">
        <span class="texto_concurso"><?php print link_to_concurso($concurso)?></span>
    </div>
    <div class="boton_vota_semana_<?php echo $concurso->getId() ?>" id="boton_vota">
        <span class="texto_concurso"> <?php echo link_to_function('ver +', 'return false;') ?>
        </span>
    </div>
    <script>
        $('.boton_vota_semana_<?php echo $concurso->getId() ?>').click(function(e){
            muestra_bocadillo_semana(e,<?php echo $concurso->getId() ?>);
        });
    </script>
</div>

<script>
    var bocadillo_semana = new Array();
    var muestra_bocadillo_semana = function(e,id)
    {
        var pos = $('.boton_vota_semana_'+id).position();

        $('#Bocadillo_semana_'+id).css('left',(pos.left+100)+'px');
        $('#Bocadillo_semana_'+id).css('top',(pos.top-$('#Bocadillo_semana_'+id).height())+'px');

        if(bocadillo_semana[id]){
            $('.bocadillo_destacados').fadeOut();
            bocadillo_semana = [];
        }
        else{
            $('.bocadillo_destacados').fadeOut();
            $('#Bocadillo_semana_'+id).fadeIn();
            bocadillo_semana[id]=true;
        }
    };
</script>
