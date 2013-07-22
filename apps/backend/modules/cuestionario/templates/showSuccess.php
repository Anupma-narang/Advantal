<div id="sf_admin_container">
    <h1><?php echo __('Detalle del cuestionario de auditoría de Empresa/Entidad', array(), 'messages') ?></h1>
    <div id="sf_admin_content">
        <div class="sf_admin_list" style="width:1160px;">
            <h2><?php echo $lista_cuestionario->getNombre() ?></h2>
            <table>
                <thead>
                    <tr>
                        <th>
                            <span class="block" style="width:490px;">Pregunta</span>
                        </th>
                        <th>
                            <span class="block" style="width:112px;">Tipo de pregunta</span>
                        </th>
                        <th>
                            <span class="block" style="width:490px;">KPI</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($lista_cuestionario->getListaCuestionarioPregunta() as $pregunta) : $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
                        <tr class='sf_admin_row <?php echo $odd ?>'>
                            <td><?php echo $pregunta->getPreguntaString(); ?></td>
                            <td><?php echo $pregunta->getTipo(); ?></td>
                            <td><?php echo $pregunta->getKpi(); ?></td>
                        </tr>
                    <?php endforeach ?>

                </tbody>

            </table>
        </div>
        <?php if (!$sf_request->isXmlHttpRequest()) : ?>
            <ul class='sf_admin_actions' style="margin-left: -2px !important;">
                <li class='sf_admin_list'>
                    <a href='<?php echo url_for("cuestionario") ?>'>Volver al Listado</a>
                </li>
            </ul>
        <?php endif ?>
    </div>
</div>
<style type="text/css">
    tr.sf_admin_row td:last-child {
        padding-left: 5px !important;
    }
</style>

