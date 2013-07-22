<?php use_stylesheet("/css/fancybox/jquery.fancybox.css") ?>
<?php use_helper('mihelper', 'alternativeLink'); ?>
<?php
$msg = "null";
$ms_values = $sf_data->getRaw("ms_values");
unset($ms_values["order"]);

$sectoresActivos = $sf_data->getRaw("sectoresActivos");
$ma_ignoreStateList = array("A Coruña", "Albacete", "Alicante", "Almería", "Vitoria-Gasteiz", "Oviedo", "Ávila", "Badajoz", "Barcelona", "Bilbao", "Burgos", "Cáceres", "Cádiz", "Santander", "Castellón de la Plana", "Ceuta", "Ciudad Real", "Córdoba", "Cuenca", "Girona", "Granada", "Guadalajara", "Donostia-San Sebastián", "Huelva", "Huesca", "Palma", "Jaén", "León", "Lleida", "Logroño", "Lugo", "Madrid", "Málaga", "Melilla", "Murcia", "Pamplona/Iruña", "Ourense", "Palencia", "Palmas de Gran Canaria (Las)", "Pontevedra", "Salamanca", "Santa Cruz de Tenerife", "Segovia", "Sevilla", "Soria", "Tarragona", "Teruel", "Toledo", "Valencia", "Valladolid", "Zamora", "Zaragoza");
?>

<!-- for activity and state_id and location -->
<?php if (isset($sectoresActivos['sector1']) && $ms_values['states_id'] != "" && $ms_values['city_id'] != "" && isset($sectoresActivos['sector2']) && isset($sectoresActivos['sector3'])): ?>
    <?php $statename = StatesTable::getInstance()->findOneById($ms_values['states_id'])->getName(); ?>
    <?php $location = CityTable::getInstance()->findOneById($ms_values['city_id']); ?>
    <?php if ($location && $location->getIsCapital()): ?>
        <?php $msg = ' en' . $sectoresActivos['sector3']['texto'] . ' en ' . $location->getName(); ?>
    <?php else: ?>
        <?php $msg = ' en ' . $sectoresActivos['sector3']['texto'] . ' en ' . $location . ' (' . $statename . ')'; ?>
    <?php endif; ?>
    <!-- for subsector and state_id and location -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['states_id'] != "" && $ms_values['city_id'] != "" && isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $statename = StatesTable::getInstance()->findOneById($ms_values['states_id'])->getName(); ?>
    <?php $location = CityTable::getInstance()->findOneById($ms_values['city_id']); ?>
    <?php if ($location && $location->getIsCapital()): ?>
        <?php $msg = ' en ' . $sectoresActivos['sector2']['texto'] . ' en ' . $location->getName(); ?>
    <?php else: ?>
        <?php $msg = ' en ' . $sectoresActivos['sector2']['texto'] . ' en ' . $location . ' (' . $statename . ')'; ?>
    <?php endif; ?>
    <!-- for sector and state_id and location -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['states_id'] != "" && $ms_values['city_id'] != "" && !isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $statename = StatesTable::getInstance()->findOneById($ms_values['states_id'])->getName(); ?>
    <?php $location = CityTable::getInstance()->findOneById($ms_values['city_id']); ?>
    <?php if ($location && $location->getIsCapital()): ?>
        <?php $msg = ' en ' . $sectoresActivos['sector1']['texto'] . ' en ' . $location->getName(); ?>
    <?php else: ?>
        <?php $msg = ' en ' . $sectoresActivos['sector1']['texto'] . ' en ' . $location . ' (' . $statename . ')'; ?>
    <?php endif; ?>
    <!-- for activity and state_id -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['states_id'] != "" && isset($sectoresActivos['sector2']) && isset($sectoresActivos['sector3'])): ?>
    <?php $statename = StatesTable::getInstance()->findOneById($ms_values['states_id'])->getName(); ?>
    <?php $msg = ' en ' . $sectoresActivos['sector3']['texto'] . ' en ' . $statename; ?>
    <!-- for subsector and state_id -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['states_id'] != "" && isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $statename = StatesTable::getInstance()->findOneById($ms_values['states_id'])->getName(); ?>
    <?php $msg = ' en ' . $sectoresActivos['sector2']['texto'] . ' en ' . $statename; ?>
    <!-- for sector and state_id -->
<?php elseif (isset($sectoresActivos['sector1']) && $ms_values['states_id'] != "" && !isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $statename = StatesTable::getInstance()->findOneById($ms_values['states_id'])->getName(); ?>
    <?php $msg = ' en ' . $sectoresActivos['sector1']['texto'] . ' en ' . $statename; ?>
    <!-- for sector -->
<?php elseif (isset($sectoresActivos['sector1']) && !isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $msg = ' en ' . $sectoresActivos['sector1']['texto']; ?>
    <!-- for subsector -->
<?php elseif (isset($sectoresActivos['sector1']) && isset($sectoresActivos['sector2']) && !isset($sectoresActivos['sector3'])): ?>
    <?php $msg = ' en ' . $sectoresActivos['sector2']['texto']; ?>
    <!-- for activity -->
<?php elseif (isset($sectoresActivos['sector1']) && isset($sectoresActivos['sector2']) && isset($sectoresActivos['sector3'])): ?>
    <?php $msg = ' en ' . $sectoresActivos['sector3']['texto']; ?>
    <!-- for Empresa/Entidad and Categoria excelencia-->
<?php elseif (count(array_filter($ms_values)) > 0): ?>
    <?php $msg = ' con esas características'; ?>
<?php else: ?>
    <?php $msg = ' en el Directorio'; ?>
<?php endif; ?>

<?php if ($msg != 'null'): ?>
    <?php
    if ($profesionalDestacadas->count() > 0) {
        $totRes = $pager->count() + $profesionalDestacadas->count();
    } else {
        $totRes = $pager->count();
    }
    ?>
    <div class="spanMsgThis">Hay <?php echo $totRes; ?><?php echo ($totRes == 1) ? ' profesional ' : ' profesionales '; ?><?php echo $msg; ?></div>
<?php endif; ?>


<?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('global/pagination', array('pager' => $pager, 'ruta' => '@lista_profesional', 'params' => array())) ?>
<?php endif; ?>
<?php if ($pager->count() == 0 && $profesionalDestacadas->count() == 0) : ?>
    <?php if ($buscandoPorSector) : ?>
        <p style="font-size:14px;">
            <strong>No hemos publicado ningún profesional en este apartado. Si crees que alguno merece estar aquí</strong>
        <!--            <strong>Aún no hemos publicado ningún profesional en este apartado.</strong><br><br><strong>Si crees que alguno merece estar aquí </strong>-->
            <?php echo authenticated_link_to($sf_user, "¡recomienda un profesional!", "profesional/index", "¡recomienda un profesional!", "nosotros_lightboxes/accesocuenta?texto=2&redirect=profesionalindex", array('title' => '¡recomienda un profesional!'), array('title' => 'Recomienda un nuevo profesional para formar parte del Directorio', 'class' => 'lightbox-i')) ?></p>
        <!--a href='<?php echo url_for('profesional/index') ?>' title='Recomienda un nuevo profesional para formar parte del Directorio'>recomienda un nuevo profesional</a>!</p-->
    <?php else : ?>
        <p style="font-size:14px;">
            <strong> No hemos encontrado profesionales con esas características.</strong>
        </p>
    <?php endif ?>
<?php endif ?>


<?php if ($profesionalDestacadas->count() > 0) : ?>
    <div class='empresas_destacadas'>
        <center><h2>PROFESIONALES DESTACADOS</h2></center>
        <?php $pro_cnt = 1; ?>
        <?php foreach ($profesionalDestacadas as $profesional) : ?>
            <?php
            $isRecomendation = Doctrine::getTable('Profesional')->getLettersCount($profesional->getId(), 1);
            $isDescription = Doctrine::getTable('Profesional')->getLettersCount($profesional->getId(), 2);
            ?>
            <?php include_partial('profesional', array('profesional' => $profesional, 'key' => $pro_cnt, 'isRecomendation' => $isRecomendation, 'isDescription' => $isDescription)); ?>
            <?php $pro_cnt++; ?>
        <?php endforeach ?>
        <div class='clear'></div>
    </div>
<?php endif ?>

<?php foreach ($pager as $profesional): ?>
    <?php
    $isRecomendation = Doctrine::getTable('Profesional')->getLettersCount($profesional->getId(), 1);
    $isDescription = Doctrine::getTable('Profesional')->getLettersCount($profesional->getId(), 2);
    ?>
    <?php include_partial('profesional', array('profesional' => $profesional, 'isRecomendation' => $isRecomendation, 'isDescription' => $isDescription)); ?>
<?php endforeach; ?>

<?php if ($pager->haveToPaginate()): ?>
    <?php include_partial('global/pagination', array('pager' => $pager, 'ruta' => '@lista_profesional', 'params' => array())) ?>
<?php endif; ?>

<style type="text/css">
    /*.spanMsg {text-align: right; padding-left: 97px !important;}*/
</style>
<script type='text/javascript'>
    $(function() {
        $('.spanMsg').text($('.spanMsgThis').text());
        $('.dynamicBar').sparkline('html', {
            type: 'bar',
            barColor: 'green',
            colorMap: {
                '1': '#429D29',
                '2': '#B41B1D',
                '3': '#BEC1C4',
                '4': '#F65E13'
            },
            tooltipFormat: '{{value:levels}}',
            tooltipValueLookups: {
                levels: {'1': 'Sin medalla', '2': 'Bronze', '3': 'Plata', '4': 'Oro'}
            }
        });

    });

    function setUrl(id, url)
    {
        $("#wholeDiv" + id).attr('onclick', "window.location.href='" + url + "'");
    }
</script>
