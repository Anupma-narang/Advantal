<?php use_helper('Util'); ?>
<table>
    <thead>
        <tr>
            <th>Kpi</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($kpis as $kpi) : ?>
            <tr>
                <td><?php echo $kpi->getKpi() ?></td>
                <td><?php echo mostrar5centesimas($kpi->getMedia()) ?></td>

            </tr>
        <?php endforeach ?>
    </tbody>
</table>
