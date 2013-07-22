<?php use_helper('Text') ?>
<?php //use_javascript('fancybox/jquery.fancybox.js') ?>
<?php //use_stylesheet('fancybox/jquery.fancybox.css') ?>

<div id="sf_admin_container">
    <h1>Detalle del profesional</h1>

    <div id="sf_admin_content">
        <ul>
            <li><strong>Usuario:</strong> <?php echo __($profesional->last_name_one." ".$profesional->last_name_two.", ".$profesional->first_name, array(), 'messages') ?></li>
            <li><strong>Sector profesional:</strong> <?php echo $profesional->getProfesionalTipoUno();?> </li>
            <li><strong>Actividad:</strong>
                <?php    
                    if(!$profesional->getProfesionalTipoTresId())
                        echo $profesional->getProfesionalTipoDos();
                    else
                        echo $profesional->getProfesionalTipoTres();
                ?>
            </li>
            <li><strong>Estado:</strong> <?php echo $profesional->ProfesionalEstado->name ?></li>
            <li><strong>Dirección:</strong> <?php echo $profesional->address ?></li>
            <li><strong>Teléfono:</strong> <?php echo $profesional->telefono ?></li>
            <li><strong>Correo electronico:</strong> <?php echo $profesional->email ?></li>
            <li><strong>Provincia:</strong> <?php echo $profesional->States->name ?></li>
            <li><strong>Localidad:</strong> <?php echo $profesional->getCity()->getName() ?></li>
            <li><strong>Tipo de vía:</strong> <?php echo $profesional->RoadType->name ?></li>
            <li><strong>Dirección:</strong> <?php echo $profesional->address ?>, Nº: <?php echo $profesional->numero ?>, <?php echo $profesional->piso ? 'Piso:' . $profesional->piso . ', ' : '' ?> <?php echo $profesional->puerta ? 'Puerta: ' . $profesional->puerta : '' ?></li>
            
            <?php if ($profesional->getFechaNulo()): ?>
                <li>Fecha anulado: <?php echo format_datetime($profesional->fecha_nulo, "HH:mm dd/MM/y", "es_ES") ?></li>
            <?php endif; ?>
        </ul>

        <?php if ($profesional->profesional_estado_id == 4): // Deliberación ?>
            <?php /*$results = $profesional->getReferendumResult() ?>
            <?php if (count($results)): ?>
                <br/>
                <h3>Resultado del profesional</h3>
                <table class="results">
                    <thead><tr><th>Puesto</th><th>Colaborador</th><th>Contribución</th><th>Puntos</th><th>Colaboradores que le han votado</th></tr></thead>
                    <tbody>
                    <?php
                        $count = 1;
                        foreach ($results as $r)
                        {
                            printf('<tr><td class="num">%s</td><td>%s</td><td>%s</td><td class="num">%s</td><td class="num">%s</td></tr>',
                                $count, $r['username'], link_to($r['contribucion_name'], "contribucion/show?id=".$r['contribucion_id']), $r['puntos'], $r['votos']);
                            $count = $count + 1;
                        }
                    ?>
                    </tbody>
                </table>
            <?php endif; */?>
        <?php endif; ?>
    </div>

    <ul class='sf_admin_actions'>
        <li class='sf_admin_action_list'><?php echo link_to('Volver a profesional', '@profesional_lista', array('class' => 'sf_admin_action_cancel'))?></li>
        <li class='sf_admin_action_list'><?php echo link_to('Volver a profesional en lista', '@profesional_lista', array('class' => 'sf_admin_action_cancel'))?></li>
        <li class='sf_admin_action_edit'><?php echo link_to('Editar', 'profesional_lista_edit', array('id' => $profesional->getId()), array('class' => 'sf_admin_action_edit'))?></li>
    </ul>
</div>
