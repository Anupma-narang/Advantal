<?php use_helper('Util'); ?>
<table class="categoria_lista" width="100%">
    <thead>
        <tr>
            <th width="60%">KPIs</th>
            <th width="40%">Puntuación (0-5)</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($kpis as $kpi) : ?>
            <tr>
                <td class="kpi"><?php echo $kpi->getKpi() ?></td>
                <td align="center"><?php echo mostrar5centesimas($kpi->getMedia()); ?></td>

            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<style type="text/css">
    table.categoria_lista tr th{ color: #B41B1D;}
    table.categoria_lista tr td{ font-size: 14px; font-weight: bold;}
    table.categoria_lista tr td:last-child{ color:#FF1919;}
    .categoria_lista { float: left; margin: 16px 0 0 0;}
</style>
