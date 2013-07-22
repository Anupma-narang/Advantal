<div id="sf_admin_container">
    <h1>Ver tabla de puntos</h1>
    <div id="sf_admin_content">
        <table>
            <thead><tr><th>Código</th><th>Descripción</th><th>Puntos</th></tr></thead>
            <tbody>
                <tr>
                    <td><?php echo $punto->getCodigo() ?></td>
                    <td><?php echo $punto->getDescripcion() ?></td>
                    <td><?php echo $punto->getPuntos() ?></td>
                </tr>
            </tbody>
        </table>  
    </div>
    <ul class="sf_admin_actions" style="margin: 10px 10px 10px 0 !important;">
        <li class="sf_admin_action_list">
            <?php echo link_to('Volver al Listado', 'colaboradorpuntodefinicion/index') ?>
        </li>
    </ul>    
</div>