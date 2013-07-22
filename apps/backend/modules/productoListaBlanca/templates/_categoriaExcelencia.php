<?php use_helper('Util'); ?>
<table>
    <thead>
        <tr>
            <th class="producto_kpi" width="43%">KPIs</th>
            <th width="5%">Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php $c = 1; ?>
        <?php foreach ($kpis as $kpi) : ?>
            <tr>
                <td class="producto_kpi"><?php echo $c . ") "; ?><?php $c++; ?><?php echo $kpi->getKpi() ?></td>
                <td><?php echo mostrar5centesimas($kpi->getMedia()) ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<style type="text/css">
    table{float: left; width:50% !important; margin-left: 8px;}
</style>