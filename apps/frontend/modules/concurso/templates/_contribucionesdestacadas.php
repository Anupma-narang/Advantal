<?php use_helper('Date', 'Text','Concursos') ?>
<?php if(isset($concurso) && in_array($concurso->getConcursoEstadoId(), array(4,5,6,8))):?>
    <?php // Concursos en deliberación, observación, cerrados o nulos ?>

    <?php $results = $concurso->getReferendumResult(10); ?>
    <?php if(count($results)): ?>
        <div id="puntuaciones_destacadas">
            <div align="center">
                <span class="titulo_destacado">Ganadores del concurso</span>
            </div>
            <?php echo image_tag("img/linea_concursos_destacados.png") ?>
            <ul>
            <?php foreach ($results as $i=>$ref): ?>
                <li<?php print $i<3?' class="strong"':'' ?>>
                    <?php print $i+1 ?>º - <?php print $ref['username'] ?>, <?php print $ref['puntos'] ?> <?php print $ref['puntos']>1?'puntos':'punto' ?>
                </li>
            <?php endforeach; ?>
            </ul>
            <?php echo link_to_function('ver resultado del Referéndum', "goToByScroll('tabla_puntuaciones')")?>
        </div>
        <script>function goToByScroll(id){$('html,body').animate({scrollTop: $("#"+id).offset().top},'fast')}</script>
    <?php endif; ?>
<?php else:?>
    <div id="contribuciones_destacadas">
	<div align="center">
            <span class="titulo_destacado">Contribuciones Destacadas</span>
	</div>
	<?php echo image_tag("img/linea_concursos_destacados.png") ?>
	<?php if(isset($contribucionesdestacadas)):?>
            <?php if(count($contribucionesdestacadas)==0):?>
                    <p>Aún no hemos destacado ninguna contribución.
                        <br/>¿Crees que alguna se merece estar aquí?
                        <br/><?php print link_to_contribuye($concurso) ?>
                    </p>
            <?php endif;?>

            <?php foreach ($contribucionesdestacadas as $contribucion): ?>
                <div id="enumera_contribucion">
                    <div align="center">
                        <?php print link_to($contribucion->name, url_for_concurso($contribucion->getConcurso())); ?>
                    </div>
                    <hr/>
                    <div class="fecha"><?php echo format_datetime($contribucion->created_at, "p", "es_ES") ?></div>
                    <div class="estado" style="float: right;"><?php echo $contribucion->getContribucionEstado()->getName() ?></div>
                    <div id="categoria_concurso" class="label"><?php echo $contribucion->Concurso->ConcursoCategoria->name ?></div>
                    <div class="creado_por">
                        <?php
                        if($sf_user->isAuthenticated() and $contribucion->getUserId() == $sf_user->getGuardUser()->getId())
                            print __('Creado por ti');
                        else
                            print __('Creado por: %%username%%',array('%%username%%' => $contribucion->getUser()->getUserName()));
                        ?>
                    </div>
                    <div class="resumen">
                        <?php echo "Resumen Plan de acción: " . truncate_text(html_entity_decode($contribucion->resumen), $length = 150) ?>
                    </div>
                    <div style="text-align:right">
                        <?php
                            $n = 1;
                            $tmp = 'ib'.$contribucion->getId().'_'.$n;
                            $link = link_to('ver +', array(
                                'module' => 'concurso',
                                'action' => 'showIncidenciaBocadillo',
                                'nombre' => $concurso->getProducto_or_Empresa_NameSlug(),
                                'slug' => $concurso->getSlug(),
                                'date' => $concurso->getDateTimeObject('created_at')->format('d-m-Y'),
                                'time' => $concurso->getDateTimeObject('created_at')->format('H:i'),
                                'number' => $contribucion->getNumero()), array('absolute'=>true, 'id'=>$tmp, 'class'=>'fancybox.ajax'));
                            print $link . javascript_tag("$('#$tmp').fancybox({maxWidth:800,maxHeight:600,fitToView:false,width:'70%',height:'70%',autoSize:false,padding:20,closeClick:false});");
                        ?>
                    </div>

                    <?php if ($contribucion->Concurso->concurso_estado_id==3): ?>
                        <?php include_component('concurso', 'votacion', array('contribucion'=>$contribucion)) ?>
                    <?php endif; ?>

                </div>
                <div style="clear: both"></div>
            <?php endforeach; ?>
	<?php endif;?>
    </div>
<?php endif;?>